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

    public function show(string $id)
    {
        $scenario = Scenario::where('id', $id)->firstOrFail();

        $items = Data::where('scenario_id', $id)
            ->where('year', 2050)
            ->with('category')
            ->get();

        $configCapacity = [
            'type' => 'doughnut',
            'data' => [
                'labels' => $items->filter(function ($item, $key) {
                    return $item->capacity > 0;
                })->map(function ($item) {
                    return (string)$item->category->name;
                })->values()->toArray(),
                'datasets' => [
                    [
                        'label' => 'TWh',
                        'data' => $items->filter(function ($item, $key) {
                            return $item->production > 0;
                        })->map(function ($item) {
                            return (string)$item->production;
                        })->values()->toArray(),
                        'backgroundColor' => $items->filter(function ($item, $key) {
                            return $item->production > 0;
                        })->map(function ($item) {
                            return catColor($item->category->name);
                        })->values()->toArray(),
                        'borderColor' => 'transparent',
                    ],
                    [
                        'label' => 'GW',
                        'data' => $items->filter(function ($item, $key) {
                            return $item->capacity > 0;
                        })->map(function ($item) {
                            return (string)$item->capacity;
                        })->values()->toArray(),
                        'backgroundColor' => $items->filter(function ($item, $key) {
                            return $item->capacity > 0;
                        })->map(function ($item) {
                            return catColor($item->category->name);
                        })->values()->toArray(),
                        'borderColor' => 'transparent',
                        'spacing' => '2',
                    ],
                ]
            ],
            'options' => [
                'plugins' => [
                    'datalabels' => [
                        'backgroundColor' => '#191d21',
                        'color' => 'white',
                        'borderRadius' => 5
                    ]
                ]
                //'maintainAspectRatio' => false,
            ]
        ];

        return view('scenarios.show', [
            'scenario' => $scenario,
            'withDataLabel' => true,
            'jsonConfig' => json_encode($configCapacity),
            'previousScenario' => $scenario->previous(),
            'nextScenario' => $scenario->next(),
            'showLabel' => true,
            'totalCapacity' => (int)$items->sum(function ($item) {
                return $item->capacity;
            }),
            'totalProduction' => (int)$items->sum(function ($item) {
                return $item->production;
            }),
            'totalSpace' => (int)$items->sum(function ($item) {
                return (float)$item->capacity * resourceIntensityRTE($item->category->key, 'space') * 1000;
            }),
            'totalCarbon' => (int)(
                $items->sum(function ($item) {
                    return carbonIntensity($item->category->key) * $item->production;
                })
                / $items->sum(function ($item) {
                    return $item->production;
                })
            )
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
        $scenario = Scenario::where('id', $id)->firstOrFail();

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

        return view('scenarios.show_' . $type, [
            'previousScenario' => $scenario->previous(),
            'nextScenario' => $scenario->next(),
            'scenario' => Scenario::where('id', $id)->firstOrFail(),
            'jsonConfig' => json_encode($config),
            'type' => $type
        ]);
    }
}
