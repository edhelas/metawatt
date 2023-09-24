<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\Scenario;
use App\Models\Category;
use Illuminate\Http\Request;

class ScenarioController extends Controller
{
    public function index(Request $request)
    {
        return view('scenarios.index', ['groups' => Scenario::all()->groupBy('group')]);
    }

    public function show(string $slug)
    {
        $scenario = Scenario::where('slug', $slug)->firstOrFail();

        $maxYear = (int)Data::where('scenario_id', $scenario->id)->orderBy('year', 'desc')->firstOrFail()->year;

        $items = Data::where('scenario_id', $scenario->id)
            ->noStorage()->noFinal()
            ->where('year', $maxYear)
            ->with('category')
            ->get();

        $itemsRenewable = Data::where('scenario_id', $scenario->id)
            ->noStorage()->noFinal()->renewable()
            ->where('year', $maxYear)
            ->with('category')
            ->get();

        $itemsLowCarbon = Data::where('scenario_id', $scenario->id)
            ->noStorage()->noFinal()->lowCarbon()
            ->where('year', $maxYear)
            ->with('category')
            ->get();

        $finalConsumption = Data::where('scenario_id', $scenario->id)
            ->whereIn('category_id', function ($query) {
                $query->select('id')
                    ->from('categories')
                    ->where('key', 'final');
            })
            ->where('year', $maxYear)
            ->with('category')
            ->first();

        $configCapacity = [
            'type' => 'doughnut',
            'data' => [
                'labels' => $items->filter(function ($item, $key) {
                    return $item->production > 0 || $item->capacity > 0;
                })->map(function ($item) {
                    return (string)$item->category->key;
                })->values()->toArray(),
                'datasets' => [
                    [
                        'label' => 'TWh',
                        'data' => $items->filter(function ($item, $key) {
                            return $item->production > 0 || $item->capacity > 0;
                        })->map(function ($item) {
                            return (string)$item->production;
                        })->values()->toArray(),
                        'backgroundColor' => $items->filter(function ($item, $key) {
                            return $item->production > 0 || $item->capacity > 0;
                        })->map(function ($item) {
                            return $item->category->color;
                        })->values()->toArray(),
                        'borderColor' => 'transparent',
                    ],
                    [
                        'label' => 'GW',
                        'data' => $items->filter(function ($item, $key) {
                            return $item->production > 0 || $item->capacity > 0;
                        })->map(function ($item) {
                            return (string)$item->capacity;
                        })->values()->toArray(),
                        'backgroundColor' => $items->filter(function ($item, $key) {
                            return $item->production > 0 || $item->capacity > 0;
                        })->map(function ($item) {
                            return $item->category->color;
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
            'maxYear' => $maxYear,
            'categories' => Category::all(),
            'withDataLabel' => true,
            'jsonConfig' => json_encode($configCapacity),
            'previousScenario' => $scenario->previous(),
            'nextScenario' => $scenario->next(),
            'showLabel' => true,
            'finalConsumption' => $finalConsumption,
            'totalRenewable' => (int)$itemsRenewable->sum(function ($item) {
                return $item->capacity;
            }),
            'totalLowCarbon' => (int)$itemsLowCarbon->sum(function ($item) {
                return $item->capacity;
            }),
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

    public function showCapacity(string $slug)
    {
        return $this->prepareShow($slug, 'capacity');
    }

    public function showEnergy(string $slug)
    {
        return $this->prepareShow($slug, 'energy');
    }

    public function prepareShow(string $slug, string $type)
    {
        $scenario = Scenario::where('slug', $slug)->firstOrFail();

        $items = Data::where('scenario_id', $scenario->id);

        if ($type == 'energy') {
            $item = $items->noStorage()->noFinal();
        }

        $items = $items->orderBy('year')
            ->with('category')
            ->get();

        $categories = [];

        foreach ($items as $item) {
            if (!in_array($item->category->key, array_keys($categories))) {
                $categories[$item->category->name] = [
                    'label' => $item->category->title,
                    'tension' => 0.3,
                    'borderColor' => $item->category->color,
                    'backgroundColor' => $item->category->color,
                    'data' => [],
                    'fill' => $type == 'energy'
                ];
            }

            array_push(
                $categories[$item->category->name]['data'],
                $type == 'capacity'
                    ? (float)$item->capacity
                    : (float)$item->production
            );
        }

        $labels = Data::distinct('year')->where('scenario_id', $scenario->id)->get()->pluck('year');

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

        if ($type == 'energy') {
            $categories['consumption'] = $this->getFinalConsumption($scenario);
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
                'radius' => $type == 'energy' ? 0 : 6,
                'scales' => [
                    'y' => [
                        'stacked' => $type == 'energy',
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
            'scenario' => $scenario,
            'jsonConfig' => json_encode($config),
            'type' => $type
        ]);
    }

    private function getFinalConsumption(Scenario $scenario): array
    {
        return [
            'label' => 'Consommation Énergie finale',
            'data' =>
            (array)Data::selectRaw('year, production')
                ->where('scenario_id', $scenario->id)
                ->whereIn('category_id', function ($query) {
                    $query->select('id')
                          ->from('categories')
                          ->where('key', 'final');
                })
                ->orderBy('year')
                ->get()
                ->map(function ($item) {
                    return $item->production ? (float)$item->production : null;
                })
                ->values()
                ->all(),
            'borderColor' => 'gray',
            'backgroundColor' => 'rgba(0, 0, 0, 0.5)',
            'fill' => true,
            'tension' => 0.3,
            'type' => 'line',
            'stack' => 'other',
            'order' => 0,
        ];
    }
}
