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
                $scenarios[$item->scenario->name] = [
                    'label' => $item->scenario->name,
                    'tension' => 0.3,
                    'hitRadius' => 4,
                    'pointRadius' => 6,
                    'borderColor' => groupColor($item->scenario->group),
                    'data' => []
                ];
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
                $scenarios[$item->scenario->name] = [
                    'label' => $item->scenario->name,
                    'tension' => 0.3,
                    'hitRadius' => 4,
                    'pointRadius' => 6,
                    'borderColor' => groupColor($item->scenario->group),
                    'data' => []
                ];
            }

            array_push($scenarios[$item->scenario->name]['data'], (float)$item->capacity);
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
                $scenarios[$item->scenario->name] = [
                    'label' => $item->scenario->name,
                    'tension' => 0.3,
                    'hitRadius' => 4,
                    'pointRadius' => 6,
                    'borderColor' => groupColor($item->scenario->group),
                    'data' => []
                ];
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
