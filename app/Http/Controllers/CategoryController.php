<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        return view('categories.index', [
            'categories' => Category::whereNotIn('name', storage())->where('name', '!=', 'final')->get(),
            'storage' => Category::whereIn('name', storage())->where('name', '!=', 'final')->get()
        ]);
    }

    public function showProduction(string $category)
    {
        $items = Data::where('category_id', Category::where('key', $category)->first()->id)
            ->orderBy('scenario_id')
            ->orderBy('year')
            ->with('scenario')
            ->get();

        $scenarios = [];
        $labels = getYears();

        foreach ($items as $item) {
            if (!in_array($item->scenario->name, array_keys($scenarios))) {
                $scenarios[$item->scenario->name] = scenarioBaseConfig($item->scenario);
                $scenarios[$item->scenario->name]['data'] = getDataLabels();
            }

            $scenarios[$item->scenario->name]['data'][$item->year] = $item->production ? (float)$item->production : 0;
        }

        // Cleanup empty dataset
        foreach ($scenarios as $name => $scenario) {
            $scenarios[$name]['data'] = array_values($scenarios[$name]['data']);
            if (empty(array_filter($scenario['data']))) {
                unset($scenarios[$name]);
            }
        }

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

        return view('categories.show_production', [
            'category' => Category::where('key', $category)->firstOrFail(),
            'jsonConfig' => json_encode($config)
        ]);
    }

    public function showCapacity(string $category)
    {
        $items = Data::where('category_id', Category::where('key', $category)->first()->id)
            ->orderBy('scenario_id')
            ->orderBy('year')
            ->with('scenario')
            ->get();

        $scenarios = [];

        $labels = getYears();
        $dataLabels = getDataLabels();

        foreach ($items as $item) {
            if (!in_array($item->scenario->name, array_keys($scenarios))) {
                $scenarios[$item->scenario->name] = scenarioBaseConfig($item->scenario);
                $scenarios[$item->scenario->name]['data'] = $dataLabels;

                if ($category == 'step') {
                    $scenarios[$item->scenario->name . '_capacity'] = scenarioBaseConfig($item->scenario);
                    $scenarios[$item->scenario->name . '_capacity']['label'] = $item->scenario->name . ' stockage';
                    $scenarios[$item->scenario->name . '_capacity']['yAxisID'] = "y1";
                    $scenarios[$item->scenario->name . '_capacity']['borderDash'] = [4, 2];
                    $scenarios[$item->scenario->name . '_capacity']['data'] = $dataLabels;
                }
            }

            $scenarios[$item->scenario->name]['data'][$item->year] = (float)$item->capacity;

            if ($category == 'step') {
                $scenarios[$item->scenario->name . '_capacity']['data'][$item->year] = (float)$item->production;
            }
        }

        // Cleanup empty dataset
        foreach ($scenarios as $name => $scenario) {
            $scenarios[$name]['data'] = array_values($scenarios[$name]['data']);
            if (empty(array_filter($scenario['data']))) {
                unset($scenarios[$name]);
            }
        }

        $this->addLimitsDots($scenarios, $category);

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
                            'text' => 'GW'
                        ],
                        'min' => 0,
                    ]
                ]
            ]
        ];

        if ($category == 'step') {
            $config['options']['scales']['y1'] = [
                'display' => true,
                'position' => 'right',
                'title' => [
                    'display' => true,
                    'text' => 'GWh'
                ],
                'min' => 0,
            ];
        }

        return view('categories.show_capacity', [
            'category' => Category::where('key', $category)->firstOrFail(),
            'jsonConfig' => json_encode($config),
            'sources' => $this->sources
        ]);
    }

    function showLoadFactor(string $category)
    {
        $items = Data::where('category_id', Category::where('key', $category)->first()->id)
            ->orderBy('scenario_id')
            ->orderBy('year')
            ->with('scenario')
            ->get();

        $scenarios = [];

        $labels = getYears();
        $dataLabels = getDataLabels();

        foreach ($items as $item) {
            if (!in_array($item->scenario->name, array_keys($scenarios))) {
                $scenarios[$item->scenario->name] = scenarioBaseConfig($item->scenario);
                $scenarios[$item->scenario->name]['data'] = $dataLabels;
            }

            $scenarios[$item->scenario->name]['data'][$item->year] = loadFactor((float)$item->capacity, (float)$item->production);
        }

        // Cleanup empty dataset
        foreach ($scenarios as $name => $scenario) {
            $scenarios[$name]['data'] = array_values($scenarios[$name]['data']);
            if (empty(array_filter($scenario['data']))) {
                unset($scenarios[$name]);
            }
        }

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
                            'text' => '%',
                        ],
                        'min' => 0,
                        'max' => 100
                    ]
                ]
            ]
        ];

        return view('categories.load_factor_show', [
            'category' => Category::where('key', $category)->firstOrFail(),
            'jsonConfig' => json_encode($config)
        ]);
    }

    private function addLimitsDots(array &$scenarios, string $category)
    {
        switch ($category) {
            case 'sun':
                $scenarios['field_abandoned_zones_ademde'] = [
                    'label' => 'Gisement Zones Délaissées*',
                    'data' => [
                        53, null, null, null, 53
                    ],
                    'borderColor' => 'rgba(125, 133, 109, 1)',
                    'backgroundColor' => 'transparent',
                    'fill' => true,
                    'pointRadius' => 5,
                    'order' => 101,
                ];
                $scenarios['field_parking_zones_ademde'] = [
                    'label' => 'Gisement Parkings*',
                    'data' => [
                        4, null, null, null, 4
                    ],
                    'borderColor' => 'rgba(13, 111, 180, 1)',
                    'backgroundColor' => 'transparent',
                    'fill' => true,
                    'pointRadius' => 5,
                    'order' => 100,
                ];

                $this->addSource(
                    '*',
                    "ADEME 2019 - Évaluation du gisement relatif aux zones délaissées et artificialisées propices à l'implantation de centrales photovoltaïques",
                    'https://librairie.ademe.fr/energies-renouvelables-reseaux-et-stockage/846-evaluation-du-gisement-relatif-aux-zones-delaissees-et-artificialisees-propices-a-l-implantation-de-centrales-photovoltaiques.html'
                );
                break;
        }
    }
}
