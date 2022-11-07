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
            'categories' => Category::all()
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

            array_push($scenarios[$item->scenario->name]['data'], (float)$item->production);
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
            'jsonConfig' => json_encode($config)
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
                'maintainAspectRatio'=> false,
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
}
