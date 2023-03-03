<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\Scenario;
use Illuminate\Http\Request;

class ImpactController extends Controller
{
    private $referenceYear = 2020;
    private $year = 2050;

    public function index(Request $request)
    {
        return view('impacts.index', [
            'resources' => resources()
        ]);
    }

    public function production()
    {
        $items = Data::selectRaw('scenario_id, year, sum(production) as sum')
            ->noStorage()->noFinal()
            ->groupBy('scenario_id')
            ->groupBy('year')
            ->orderBy('scenario_id')
            ->orderBy('year')
            ->with('scenario')
            ->get();

        $scenarios = [];

        foreach ($items as $item) {
            if (!in_array($item->scenario->name, array_keys($scenarios))) {
                $scenarios[$item->scenario->name] = [
                    'label' => $item->scenario->name,
                    'tension' => 0.3,
                    'borderColor' => groupColor($item->scenario->group, $item->scenario->slug),
                    'data' => []
                ];
            }

            array_push($scenarios[$item->scenario->name]['data'], (float)$item->sum);
        }

        $labels = Data::distinct('year')->get()->pluck('year');

        $config = [
            'type' => 'line',
            'data' => [
                'labels' => $labels,
                'datasets' => array_values($scenarios)
            ],
            'options' => [
                'maintainAspectRatio' => false,
                'spanGaps' => true,
                'scales' => [
                    'y' => [
                        'title' => [
                            'display' => true,
                            'text' => 'TWh'
                        ]
                    ]
                ]
            ]
        ];

        return view('impacts.production.show', [
            'jsonConfig' => json_encode($config)
        ]);
    }

    public function productionFinal(Request $request, $resource = false)
    {
        $items = Data::with(['category', 'scenario'])
            ->noStorage()->noFinal()
            ->orderBy('scenario_id')
            ->orderBy('category_id')
            ->orderBy('year')
            ->where('year', '<=', $this->year)
            ->get();

        $categories = [];
        $scenarioId = null;
        $categoryKey = null;
        $previousProduction = 0;
        $previousYear = 0;

        $totalArea = 0;

        foreach ($items as $item) {
            // Intialize
            if (!in_array($item->category->key, array_keys($categories))) {
                $categories[$item->category->key] = [
                    'label' => $item->category->key,
                    'borderColor' => $item->category->color,
                    'backgroundColor' => $item->category->color,
                    'data' => [],
                    'order' => 1
                ];
            }

            if ($categoryKey == null) {
                $scenarioId = $item->scenario_id;
                $categoryKey = $item->category->key;
                $previousYear = $item->year;
            }

            // Seed
            if (
                $item->scenario_id == $scenarioId
                && $item->category->key == $categoryKey
                && $item->year != $previousYear
            ) {
                // We are in between two years for a scenario, for a category, we interpolate
                $totalArea += (($item->production + $previousProduction) / 2) * ($item->year - $previousYear) / 1000;
            } else if (
                $item->category->key != $categoryKey
                || $item->scenario_id != $scenarioId
            ) {
                if ($resource) {
                    $totalArea *= resourceIntensityRTE($categoryKey, $resource);
                }

                // We just switched to a new category we stack the data
                array_push($categories[$categoryKey]['data'], round($totalArea, 2));
                $totalArea = 0;
            }

            $previousProduction = $item->production;
            $previousYear = $item->year;
            $scenarioId = $item->scenario_id;
            $categoryKey = $item->category->key;
        }

        if ($resource) {
            $totalArea *= resourceIntensityRTE($categoryKey, $resource);
        }

        // And we push the last one
        array_push($categories[$categoryKey]['data'], round($totalArea, 2));

        $categories = $this->cleanup($categories);

        $labels = Scenario::orderBy('id')->get()->pluck('name')->toArray();

        $config = [
            'type' => 'bar',
            'data' => [
                'labels' => $labels,
                'datasets' => array_values($categories)
            ],
            'options' => [
                'maintainAspectRatio' => false,
                'spanGaps' => true,
                'legend' => [
                    'position' => 'right'
                ],
                'scales' => [
                    'y' => [
                        'stacked' => true,
                        'title' => [
                            'display' => true,
                            'text' => $resource ? 'kT' : 'PWh'
                        ]
                    ],
                    'x' => [
                        'stacked' => true,
                    ]
                ],
                'interaction' => [
                    'mode' => 'nearest',
                    'axis' => 'x',
                    'intersect' => false
                ],
            ]
        ];

        // Extract the percentages from the data
        $percentages = [];

        foreach ($config['data']['labels'] as $key => $label) {
            if ($key != 'biogas') {
                foreach ($config['data']['datasets'] as $category) {
                    $percentages[$label][$category['label']] = $category['data'][$key];
                }
            }
        }

        foreach ($percentages as $scenario => $data) {
            $percentages[$scenario]['total'] = array_sum(array_values($data));
        }

        return view('impacts.production.show_final', [
            'year' => $this->year,
            'jsonConfig' => json_encode($config),
            'percentages' => $percentages,
            'resources' => resources(),
            'resource' => $resource
        ]);
    }

    public function carbonPerkWh(Request $request)
    {
        return $this->carbon($request, true);
    }

    public function carbon(Request $request, bool $perkWh = false)
    {
        $items = Data::orderBy('scenario_id')
            ->noStorage()->noFinal()
            ->orderBy('year')
            ->orderBy('category_id')
            ->with(['scenario', 'category'])
            ->get();

        $scenarios = [];

        $carbonSum = 0;
        $productionSum = 0;
        $oldYear = null;
        $oldScenario = null;

        foreach ($items as $item) {
            if (!in_array($item->scenario->name, array_keys($scenarios))) {
                $scenarios[$item->scenario->name] = scenarioBaseConfig($item->scenario);
            }

            if ($item->year != $oldYear) {
                if ($oldScenario) {
                    array_push($scenarios[$oldScenario]['data'], $perkWh ? $carbonSum/$productionSum : $carbonSum);
                }

                $carbonSum = (float)$item->production * (float)carbonIntensity(
                    $item->category->key,
                    $item->category->key == 'gas' ? negaWattBiogasRatio($item->year) : 0
                );

                $productionSum = (float)$item->production;
            } else {
                $carbonSum += (float)$item->production * (float)carbonIntensity(
                    $item->category->key,
                    $item->category->key == 'gas' ? negaWattBiogasRatio($item->year) : 0
                );
                $productionSum += (float)$item->production;
            }

            $oldYear = $item->year;
            $oldScenario = $item->scenario->name;
        }

        array_push($scenarios[$items->last()->scenario->name]['data'], $perkWh ? $carbonSum/$productionSum : $carbonSum);

        $labels = Data::distinct('year')->get()->pluck('year');

        $categories['production'] = $this->getProductionDots();

        $config = [
            'type' => 'line',
            'data' => [
                'labels' => $labels,
                'datasets' => array_values($scenarios)
            ],
            'options' => [
                'maintainAspectRatio' => false,
                'spanGaps' => true,
                'scales' => [
                    'y' => [
                        'title' => [
                            'display' => true,
                            'text' => $perkWh ? 'gCO2eq/kWh' : 'kTCO2eq'
                        ]
                    ]
                ]
            ]
        ];

        return view('impacts.carbon.show', [
            'perkWh' => $perkWh,
            'jsonConfig' => json_encode($config)
        ]);
    }

    public function carbonFinal(Request $request)
    {
        $items = Data::with(['category', 'scenario'])
            ->noStorage()->noFinal()
            ->orderBy('scenario_id')
            ->orderBy('category_id')
            ->orderBy('year')
            ->where('year', '<=', $this->year)
            ->get();

        $categories = [];
        $scenarioId = null;
        $categoryKey = null;
        $previousProduction = 0;
        $previousYear = 0;

        $totalArea = 0;

        foreach ($items as $item) {
            // Intialize
            if (!in_array($item->category->key, array_keys($categories))) {
                $categories[$item->category->key] = [
                    'label' => $item->category->key . ' (' . (carbonIntensity($item->category->key)) . 'g)',
                    'borderColor' => $item->category->color,
                    'backgroundColor' => $item->category->color,
                    'data' => [],
                    'order' => 1
                ];
            }

            if ($categoryKey == null) {
                $scenarioId = $item->scenario_id;
                $categoryKey = $item->category->key;
                $previousYear = $item->year;
            }

            // Seed
            if (
                $item->scenario_id == $scenarioId
                && $item->category->key == $categoryKey
                && $item->year != $previousYear
            ) {
                // We are in between two years for a scenario, for a category, we interpolate
                $totalArea += (($item->production + $previousProduction) / 2) * ($item->year - $previousYear);
            } else if (
                $item->category->key != $categoryKey
                || $item->scenario_id != $scenarioId
            ) {
                // We just switched to a new category we stack the data
                array_push(
                    $categories[$categoryKey]['data'],
                    round(($totalArea * carbonIntensity($categoryKey, $categoryKey == 'gas' ? negaWattBiogasRatio($item->year) : 0)), 2) / 1000);
                $totalArea = 0;
            }

            $previousProduction = $item->production;
            $previousYear = $item->year;
            $scenarioId = $item->scenario_id;
            $categoryKey = $item->category->key;
        }

        // And we push the last one
        array_push(
            $categories[$categoryKey]['data'],
            round(($totalArea * carbonIntensity($categoryKey, $categoryKey == 'gas' ? negaWattBiogasRatio($previousYear) : 0)), 2) / 1000
        );

        $categories = $this->cleanup($categories, true);

        $labels = Scenario::orderBy('id')->get()->pluck('name')->toArray();

        $categories['production'] = $this->getProductionDots();

        $config = [
            'type' => 'bar',
            'data' => [
                'labels' => $labels,
                'datasets' => array_values($categories)
            ],
            'options' => [
                'maintainAspectRatio' => false,
                'spanGaps' => true,
                'legend' => [
                    'position' => 'right'
                ],
                'scales' => [
                    'y' => [
                        'stacked' => true,
                        'title' => [
                            'display' => true,
                            'text' => 'kTCO2eq'
                        ]
                    ],
                    'y1' => $this->getProductionDotsScale(),
                    'x' => [
                        'stacked' => true,
                    ]
                ],
                'interaction' => [
                    'mode' => 'nearest',
                    'axis' => 'x',
                    'intersect' => false
                ],
            ]
        ];

        return view('impacts.carbon.show_final', [
            'year' => $this->year,
            'jsonConfig' => json_encode($config),
            'resources' => resources()
        ]);
    }

    public function resource(Request $request, string $resource)
    {
        $items = Data::orderBy('scenario_id')
            ->noStorage()->noFinal()
            ->orderBy('year')
            ->orderBy('category_id')
            ->with(['scenario', 'category'])
            ->get();

        $scenarios = [];

        $capacitySumRTE = 0;
        $capacitySumIEA = 0;
        $oldYear = $items->first()->year;
        $oldScenario = null;

        foreach ($items as $item) {
            if (!in_array($item->scenario->name . '_rte', array_keys($scenarios))) {
                $scenarios[$item->scenario->name . '_rte'] = scenarioBaseConfig($item->scenario, 'RTE');
                $scenarios[$item->scenario->name . '_iea'] = scenarioBaseConfig($item->scenario, 'AIE');
            }

            if ($item->year == $oldYear) {
                $capacitySumRTE += ((in_array($resource, array_keys(resourcesFuel())))
                    ? (float)$item->production
                    : (float)$item->capacity)
                    * (float)resourceIntensityRTE($item->category->key, $resource, (int)$item->year);
                $capacitySumIEA += ((in_array($resource, array_keys(resourcesFuel())))
                    ? (float)$item->production
                    : (float)$item->capacity)
                    * (float)resourceIntensityIEA($item->category->key, $resource, (int)$item->year);
            } else {
                array_push($scenarios[$oldScenario . '_rte']['data'], $capacitySumRTE);
                array_push($scenarios[$oldScenario . '_iea']['data'], $capacitySumIEA);

                $capacitySumRTE = ((in_array($resource, array_keys(resourcesFuel())))
                    ? (float)$item->production
                    : (float)$item->capacity)
                    * (float)resourceIntensityRTE($item->category->key, $resource, (int)$item->year);
                $capacitySumIEA = ((in_array($resource, array_keys(resourcesFuel())))
                    ? (float)$item->production
                    : (float)$item->capacity)
                    * (float)resourceIntensityIEA($item->category->key, $resource, (int)$item->year);
            }

            $oldYear = $item->year;
            $oldScenario = $item->scenario->name;
        }

        array_push($scenarios[$items->last()->scenario->name . '_rte']['data'], $capacitySumRTE);
        array_push($scenarios[$items->last()->scenario->name . '_iea']['data'], $capacitySumIEA);

        $labels = Data::distinct('year')->get()->pluck('year');

        $scenarios = $this->cleanup($scenarios);

        $categories['production'] = $this->getProductionDots();

        $config = [
            'type' => 'line',
            'data' => [
                'labels' => $labels,
                'datasets' => array_values($scenarios)
            ],
            'options' => [
                'maintainAspectRatio' => false,
                'spanGaps' => true,
                'scales' => [
                    'y' => [
                        'title' => [
                            'display' => true,
                            'text' => in_array($resource, array_keys(resourcesSpace())) ? 'kha' : 'kT'
                        ]
                    ]
                ]
            ]
        ];

        return view('impacts.resource.show', [
            'resource' => $resource,
            'jsonConfig' => json_encode($config),
            'resources' => resources()
        ]);
    }

    public function resourceFinal(Request $request, string $resource)
    {
        $referenceItems = Data::where('year', $this->referenceYear)
            ->noStorage()->noFinal()
            ->where('scenario_id', 2)
            ->with(['category', 'scenario'])
            ->orderBy('category_id')
            ->get();

        $items = Data::where('year', $this->year)
            ->noStorage()->noFinal()
            ->with(['category', 'scenario'])
            ->orderBy('category_id')
            ->orderBy('scenario_id')
            ->get();

        $categories = [];

        foreach ($referenceItems as $item) {
            if (!in_array($item->category->key . '_rte', array_keys($categories))) {
                if ($resource == 'space') {
                    $categories[$item->category->key . '_rte_artificialization'] = [
                        'label' => $item->category->title . ' RTE - Artificialisation',
                        'backgroundColor' => $item->category->color,
                        'data' => [((float)$item->capacity * (float)resourceIntensityRTE($item->category->key, 'artificialization', (int)$item->year))],
                        'order' => 1,
                        'stack' => 'rte'
                    ];

                    $categories[$item->category->key . '_rte_co_use'] = [
                        'label' => $item->category->title . ' RTE - Co-usage',
                        'backgroundColor' => $item->category->darkerColor,
                        'data' => [((float)$item->capacity * (float)resourceIntensityRTE($item->category->key, 'co-use', (int)$item->year))],
                        'order' => 1,
                        'stack' => 'rte'
                    ];
                } else {
                    $categories[$item->category->key . '_rte'] = [
                        'label' => $item->category->title . ' RTE',
                        'backgroundColor' => $item->category->color,
                        'data' => [(((in_array($resource, array_keys(resourcesFuel())))
                            ? (float)$item->production
                            : (float)$item->capacity)
                            * (float)resourceIntensityRTE($item->category->key, $resource, (int)$item->year))],
                        'order' => 1,
                        'stack' => 'rte'
                    ];
                }
            }

            if (!in_array($item->category->key  . '_iea', array_keys($categories))) {
                $categories[$item->category->key . '_iea'] = [
                    'label' => $item->category->title . ' IEA',
                    'backgroundColor' => $item->category->color,
                    'data' => [(((in_array($resource, array_keys(resourcesFuel())))
                        ? (float)$item->production
                        : (float)$item->capacity)
                        * (float)resourceIntensityIEA($item->category->key, $resource, (int)$item->year))],
                    'order' => 1,
                    'stack' => 'iea'
                ];
            }
        }

        foreach ($items as $item) {
            if ($resource == 'space') {
                if (isset($categories[$item->category->name . '_rte_artificialization'])) {
                    array_push(
                        $categories[$item->category->name . '_rte_artificialization']['data'],
                        ((float)$item->capacity * (float)resourceIntensityRTE($item->category->key, 'artificialization', (int)$item->year))
                    );
                    array_push(
                        $categories[$item->category->name . '_rte_co_use']['data'],
                        ((float)$item->capacity * (float)resourceIntensityRTE($item->category->key, 'co-use', (int)$item->year))
                    );
                }
            } else {
                if (isset($categories[$item->category->name . '_rte'])) {
                    array_push(
                        $categories[$item->category->name . '_rte']['data'],
                        (((in_array($resource, array_keys(resourcesFuel())))
                            ? (float)$item->production
                            : (float)$item->capacity)
                            * (float)resourceIntensityRTE($item->category->key, $resource, (int)$item->year)
                        )
                    );
                }
            }

            if (isset($categories[$item->category->name . '_iea'])) {
                array_push(
                    $categories[$item->category->name . '_iea']['data'],
                    (((in_array($resource, array_keys(resourcesFuel())))
                        ? (float)$item->production
                        : (float)$item->capacity)
                        * (float)resourceIntensityIEA($item->category->key, $resource, (int)$item->year)
                    )
                );
            }
        }

        $labels = Scenario::get()->pluck('name')->toArray();
        $labels = array_merge(['Référence (2020)'], $labels);

        $categories['production'] = $this->getProductionDots();
        array_unshift($categories['production']['data'], 0);

        $categories = $this->cleanup($categories);

        $config = [
            'type' => 'bar',
            'data' => [
                'labels' => $labels,
                'datasets' => array_values($categories)
            ],
            'options' => [
                'maintainAspectRatio' => false,
                'spanGaps' => true,
                'legend' => [
                    'position' => 'right'
                ],
                'scales' => [
                    'y' => [
                        'stacked' => true,
                        'title' => [
                            'display' => true,
                            'text' => in_array($resource, array_keys(resourcesSpace())) ? 'kha' : 'kT'
                        ]
                    ],
                    'y1' => $this->getProductionDotsScale(),
                    'x' => [
                        'stacked' => true,
                    ],
                ],
                'interaction' => [
                    'mode' => 'nearest',
                    'axis' => 'x',
                    'intersect' => false
                ],
            ]
        ];

        return view('impacts.resource.show_final', [
            'year' => $this->year,
            'resource' => $resource,
            'jsonConfig' => json_encode($config),
            'resources' => resources()
        ]);
    }

    private function getProductionDots(): array
    {
        return [
            'label' => 'Production',
            'data' =>
            (array)Data::selectRaw('scenario_id, year, sum(production) as sum')
                ->noStorage()->noFinal()
                ->groupBy('scenario_id', 'year')
                ->orderBy('scenario_id')
                ->orderBy('year')
                ->where('year', '<=', $this->year)
                ->get()
                ->groupBy('scenario_id')
                ->map(function ($item) {
                    $sum = 0;

                    for ($i = 0; $i < $item->count() - 1; $i++) {
                        $sum += (($item[$i]->sum + $item[$i + 1]->sum) * ($item[$i + 1]->year - $item[$i]->year) / 2);
                    }

                    return $sum / 1000;
                })
                ->values()
                ->all(),
            'borderColor' => 'transparent',
            'backgroundColor' => 'white',
            'pointStyle' => 'rectRot',
            'hitRadius' => 4,
            'pointRadius' => 6,
            'type' => 'line',
            'order' => 0,
            'yAxisID' => 'y1',
        ];
    }

    private function getProductionDotsScale(): array
    {
        return [
            'type' => 'linear',
            'display' => true,
            'position' => 'right',

            'title' => [
                'display' => true,
                'text' => 'PWh'
            ],

            // grid line settings
            'grid' => [
                'drawOnChartArea' => false, // only want the grid lines for one axis to show up
            ],
        ];
    }

    private function cleanup(array $categories, bool $addBiogas = false): array
    {
        foreach ($categories as $name => $category) {
            if (array_unique($category['data']) == [0]) {
                unset($categories[$name]);
            }
        }

        if (array_key_exists('gas', $categories) && $addBiogas) {
            $categories['biogas'] = [
                'label' => 'biogas (' . (carbonIntensity('biogas')) . 'g)',
                'borderColor' => catColor('biogas'),
                'backgroundColor' => catColor('biogas'),
                'data' => [],
                'order' => 1
            ];
        }

        return $categories;
    }
}
