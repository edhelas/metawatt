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
            'categories' => Category::where('name', '!=', 'final')->get()
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

        foreach ($items as $item) {
            if (!in_array($item->scenario->name, array_keys($scenarios))) {
                $scenarios[$item->scenario->name] = scenarioBaseConfig($item->scenario);
            }

            array_push($scenarios[$item->scenario->name]['data'], $item->production ? (float)$item->production : null);
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

        foreach ($items as $item) {
            if (!in_array($item->scenario->name, array_keys($scenarios))) {
                $scenarios[$item->scenario->name] = scenarioBaseConfig($item->scenario);

                if ($category == 'step') {
                    $scenarios[$item->scenario->name . '_capacity'] = scenarioBaseConfig($item->scenario);
                    $scenarios[$item->scenario->name . '_capacity']['label'] = $item->scenario->name . ' stockage';
                    $scenarios[$item->scenario->name . '_capacity']['yAxisID'] = "y1";
                    $scenarios[$item->scenario->name . '_capacity']['borderDash'] = [4, 2];
                }
            }

            array_push($scenarios[$item->scenario->name]['data'], (float)$item->capacity);

            if ($category == 'step') {
                array_push($scenarios[$item->scenario->name . '_capacity']['data'], (float)$item->production);
            }
        }

        // Cleanup empty dataset
        foreach ($scenarios as $name => $scenario) {
            if (empty(array_filter($scenario['data']))) {
                unset($scenarios[$name]);
            }
        }

        $labels = Data::distinct('year')->get()->pluck('year');

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

        foreach ($items as $item) {
            if (!in_array($item->scenario->name, array_keys($scenarios))) {
                $scenarios[$item->scenario->name] = scenarioBaseConfig($item->scenario);
            }

            array_push($scenarios[$item->scenario->name]['data'], loadFactor((float)$item->capacity, (float)$item->production));
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
                    'borderColor' => 'transparent',
                    'backgroundColor' => 'rgba(125, 133, 109, 1)',
                    'fill' => true,
                    'pointRadius' => 5,
                    'order' => 101,
                ];
                $scenarios['field_parking_zones_ademde'] = [
                    'label' => 'Gisement Parkings*',
                    'data' => [
                        8, null, null, null, 8
                    ],
                    'borderColor' => 'transparent',
                    'backgroundColor' => 'rgba(13, 111, 180, 1)',
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
