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
        return redirect()->route('scenarios.show.production', ['scenario' => $id]);
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
                    'data' => []
                ];
            }

            array_push($categories[$item->category->name]['data'],
                $type == 'capacity'
                    ? (float)$item->capacity
                    : (float)$item->production
            );
        }

        $labels = Data::distinct('year')->get()->pluck('year');

        $config = [
            'type' => 'line',
            'data' => [
                'labels' => $labels,
                'datasets' => array_values($categories)
            ],
            'options' => [
                'maintainAspectRatio'=> false,
                'spanGaps' => true,
                'scales' => [
                    'y' => [
                        'title' => [
                            'display' => true,
                            'text' => $type == 'capacity' ? 'GW' : 'TWh'
                        ]
                    ]
                ]
            ]
        ];

        return view('scenarios.show', [
            'scenario' => Scenario::where('id', $id)->firstOrFail(),
            'jsonConfig' => json_encode($config),
            'type' => $type
        ]);
    }
}
