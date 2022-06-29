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

    public function show(string $category)
    {
        $items = Data::where('category_id', Category::where('key', $category)->first()->id)
            ->orderBy('year')
            ->with('scenario')
            ->get();

        $scenarios = [];

        foreach ($items as $item) {
            if (!in_array($item->scenario->name, array_keys($scenarios))) {
                $scenarios[$item->scenario->name] = [
                    'label' => $item->scenario->name,
                    'tension' => 0.3,
                    'borderColor' => catColor($category),
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

        return view('categories.show', [
            'category' => Category::where('key', $category)->firstOrFail(),
            'jsonConfig' => json_encode($config)
        ]);
    }
}
