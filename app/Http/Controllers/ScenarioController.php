<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\Scenario;
use Illuminate\Http\Request;

class ScenarioController extends Controller
{
    public function index(Request $request)
    {
        return view('scenarios.index', ['groups' => Scenario::all()->groupBy('group')]);
    }

    public function show(int $id)
    {
        $scenario = Scenario::where('id', $id)->firstOrFail();

        $items = Data::where('scenario_id', $id)
            ->where('year', 2050)
            ->with('category')
            ->get();

        $configCapacity = [
            'type' => 'doughnut',
            'data' => [
                'labels' => $items->map(function ($item) {
                    return (string)$item->category->name;
                })->toArray(),
                'datasets' => [
                    [
                        'label' => 'Capacity in 2050',
                        'data' => $items->map(function ($item) {
                            return (string)$item->capacity;
                        })->toArray(),
                        'backgroundColor' => $items->map(function ($item) {
                            return catColor($item->category->name);
                        })->toArray(),
                        'borderColor' => 'transparent'
                    ],
                ]
            ],
            'options' => [
                'maintainAspectRatio' => false,
            ]
        ];

        $configProduction = [
            'type' => 'doughnut',
            'data' => [
                'labels' => $items->map(function ($item) {
                    return (string)$item->category->name;
                })->toArray(),
                'datasets' => [
                    [
                        'label' => 'Production in 2050',
                        'data' => $items->map(function ($item) {
                            return (string)$item->production;
                        })->toArray(),
                        'backgroundColor' => $items->map(function ($item) {
                            return catColor($item->category->name);
                        })->toArray(),
                        'borderColor' => 'transparent',
                    ],
                ]
            ],
            'options' => [
                'maintainAspectRatio' => false,
            ]
        ];

        return view('scenarios.show', [
            'scenario' => $scenario,
            'jsonConfig' => json_encode($configCapacity),
            'jsonConfig2' => json_encode($configProduction),
        ]);
    }

    public function showCapacity(int $id)
    {
        return $this->prepareShow($id, 'capacity');
    }

    public function showProduction(int $id)
    {
        return $this->prepareShow($id, 'production');
    }

    public function prepareShow(int $id, string $type)
    {
        $items = Data::where('scenario_id', $id)
            ->orderBy('year')
            ->with('category')
            ->get();

        $categories = [];

        foreach ($items as $item) {
            if (!in_array($item->category->key, array_keys($categories))) {
                $categories[$item->category->name] = [
                    'label' => catName($item->category->name),
                    'tension' => 0.3,
                    'borderColor' => catColor($item->category->name),
                    'backgroundColor' => catColor($item->category->name),
                    'data' => [],
                    'fill' => $type == 'production'
                ];
            }

            array_push(
                $categories[$item->category->name]['data'],
                $type == 'capacity'
                    ? (float)$item->capacity
                    : (float)$item->production
            );
        }

        $labels = Data::distinct('year')->where('scenario_id', $id)->get()->pluck('year');

        foreach ($categories as $key => $dataset) {
            $notEmpty = false;
            foreach ($dataset['data'] as $value) {
                if ($value != 0) {
                    $notEmpty = true;
                    break;
                }
            }

            if (!$notEmpty) unset($categories[$key]);
        }

        $config = [
            'type' => 'line',
            'data' => [
                'labels' => $labels,
                'datasets' => array_values($categories)
            ],
            'options' => [
                'maintainAspectRatio' => false,
                'spanGaps' => true,
                'radius' => $type == 'production' ? 0 : 6,
                'scales' => [
                    'y' => [
                        'stacked' => $type == 'production',
                        'title' => [
                            'display' => true,
                            'text' => $type == 'capacity' ? 'GW' : 'TWh'
                        ]
                    ]
                ],
                'interaction' => [
                    'mode' => 'nearest',
                    'axis' => 'x',
                    'intersect' => false
                ],
            ]
        ];

        return view('scenarios.show_graph', [
            'scenario' => Scenario::where('id', $id)->firstOrFail(),
            'jsonConfig' => json_encode($config),
            'type' => $type
        ]);
    }
}
