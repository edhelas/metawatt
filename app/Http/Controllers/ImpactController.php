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

    public function showTotalProduction()
    {
        $items = Data::selectRaw('scenario_id, year, sum(production) as sum')
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
                    'borderColor' => groupColor($item->scenario->group),
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
                'maintainAspectRatio'=> false,
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

        return view('impacts.show_total_production', [
            'jsonConfig' => json_encode($config)
        ]);
    }

    public function carbon(Request $request)
    {
        $items = Data::with(['category', 'scenario'])
            ->orderBy('scenario_id')
            ->orderBy('category_id')
            ->orderBy('year')
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
                    'label' => $item->category->key . ' ('.(carbonIntensity($item->category->key)/1000).'g)',
                    'borderColor' => catColor($item->category->key),
                    'backgroundColor' => catColor($item->category->key),
                    'data' => []
                ];
            }

            if ($categoryKey == null) {
                $scenarioId = $item->scenario_id;
                $categoryKey = $item->category->key;
                $previousYear = $item->year;
            }

            // Seed
            if ($item->scenario_id == $scenarioId
             && $item->category->key == $categoryKey
             && $item->year != $previousYear) {
                // We are in between two years for a scenario, for a category, we interpolate
                $totalArea += (($item->production + $previousProduction) / 2) * ($item->year - $previousYear);

            } else if($item->category->key != $categoryKey
            || $item->scenario_id != $scenarioId) {
                // We just switched to a new category we stack the data
                array_push($categories[$categoryKey]['data'], ($totalArea * carbonIntensity($categoryKey)) / 1000000);
                $totalArea = 0;
            }

            $previousProduction = $item->production;
            $previousYear = $item->year;
            $scenarioId = $item->scenario_id;
            $categoryKey = $item->category->key;
        }

        // And we push the last one
        array_push($categories[$categoryKey]['data'], ($totalArea * carbonIntensity($categoryKey)) / 1000000);

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
                            'text' => 'MT'
                        ]
                    ],
                    'x' => [
                        'stacked' => true,
                    ]
                ]
            ]
        ];

        return view('impacts.carbon', [
            'year' => $this->year,
            'jsonConfig' => json_encode($config),
            'resources' => resources()
        ]);
    }

    public function resource(Request $request, string $resource)
    {
        $items = Data::orderBy('scenario_id')
            ->orderBy('year')
            ->orderBy('category_id')
            ->with(['scenario', 'category'])
            ->get();

        $scenarios = [];

        $capacitySum = 0;
        $oldYear = $items->first()->year;
        $oldScenario = null;

        foreach ($items as $item) {
            if (!in_array($item->scenario->name, array_keys($scenarios))) {
                $scenarios[$item->scenario->name] = [
                    'label' => $item->scenario->name,
                    'tension' => 0.3,
                    'borderColor' => groupColor($item->scenario->group),
                    'data' => []
                ];
            }

            if ($item->year == $oldYear) {
                $capacitySum += (float)$item->capacity * (float)resourceIntensityRTE($item->category->key, $resource);
            } else {
                array_push($scenarios[$oldScenario]['data'], $capacitySum/1000);

                $capacitySum = (float)$item->capacity * (float)resourceIntensityRTE($item->category->key, $resource);
            }

            $oldYear = $item->year;
            $oldScenario = $item->scenario->name;
        }

        array_push($scenarios[$items->last()->scenario->name]['data'], $capacitySum/1000);

        $labels = Data::distinct('year')->get()->pluck('year');

        $config = [
            'type' => 'line',
            'data' => [
                'labels' => $labels,
                'datasets' => array_values($scenarios)
            ],
            'options' => [
                'maintainAspectRatio'=> false,
                'spanGaps' => true,
                'scales' => [
                    'y' => [
                        'title' => [
                            'display' => true,
                            'text' => $resource == 'space' ? 'kha' : 'kT'
                        ]
                    ]
                ]
            ]
        ];

        return view('impacts.show', [
            'resource' => $resource,
            'jsonConfig' => json_encode($config),
            'resources' => resources()
        ]);
    }

    public function resourceFinal(Request $request, string $resource)
    {
        $referenceItems = Data::where('year', $this->referenceYear)
            ->where('scenario_id', 2)
            ->with(['category', 'scenario'])
            ->orderBy('category_id')
            ->get();

        $items = Data::where('year', $this->year)
            ->with(['category', 'scenario'])
            ->orderBy('category_id')
            ->orderBy('scenario_id')
            ->get();

        $categories = [];

        foreach ($referenceItems as $item) {
            if (!in_array($item->category->key, array_keys($categories))) {
                $categories[$item->category->key] = [
                    'label' => $item->category->key,
                    'borderColor' => catColor($item->category->key),
                    'backgroundColor' => catColor($item->category->key),
                    'data' => [((float)$item->capacity * (float)resourceIntensityRTE($item->category->key, $resource))/1000]
                ];
            }
        }

        foreach ($items as $item) {
            if (isset($categories[$item->category->name])) {
                array_push($categories[$item->category->name]['data'], ((float)$item->capacity * (float)resourceIntensityRTE($item->category->key, $resource))/1000);
            }
        }

        $labels = Scenario::get()->pluck('name')->toArray();
        $labels = array_merge(['Référence (2020)'], $labels);

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
                            'text' => $resource == 'space' ? 'kha' : 'kT'
                        ]
                    ],
                    'x' => [
                        'stacked' => true,
                    ]
                ]
            ]
        ];

        return view('impacts.show_final', [
            'year' => $this->year,
            'resource' => $resource,
            'jsonConfig' => json_encode($config),
            'resources' => resources()
        ]);
    }
}
