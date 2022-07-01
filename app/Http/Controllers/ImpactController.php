<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\Scenario;
use Illuminate\Http\Request;

class ImpactController extends Controller
{
    public function index(Request $request)
    {
        return view('impacts.index', [
            'resources' => resources()
        ]);
    }

    public function carbon(Request $request)
    {
        return view('impacts.carbon');
    }

    public function space(Request $request)
    {
        return view('impacts.carbon');
    }

    public function resources(Request $request, string $resource)
    {
        $items = Data::where('year', '2050')
            ->with(['category', 'scenario'])
            ->orderBy('category_id')
            ->orderBy('scenario_id')
            ->get();

        $categories = [];

        foreach ($items as $item) {
            if (!in_array($item->category->key, array_keys($categories))) {
                $categories[$item->category->key] = [
                    'label' => $item->category->key,
                    'tension' => 0.3,
                    'borderColor' => catColor($item->category->key),
                    'backgroundColor' => catColor($item->category->key),
                    'data' => []
                ];
            }

            array_push($categories[$item->category->name]['data'], (float)$item->capacity * (float)resourceIntensityRTE($item->category->key, $resource));
        }

        $labels = Scenario::get()->pluck('name');

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
                            'text' => 'T'
                        ]
                    ],
                    'x' => [
                        'stacked' => true,
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
}
