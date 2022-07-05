<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\Scenario;
use Illuminate\Http\Request;

class ImpactController extends Controller
{
    private $referenceYear = 2020;
    private $year = 2050;

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
        $referenceItems = Data::where('year', $this->referenceYear)
            ->where('scenario_id', 2)
            ->with(['category', 'scenario'])
            ->orderBy('category_id')
            ->get();

        $items = Data::where('year', $this->year)
            ->with(['category', 'scenario'])
            ->orderBy('category_id')
            ->orderBy('scenario_id')
            ->get();

        $categories = [];

        foreach ($referenceItems as $item) {
            if (!in_array($item->category->key, array_keys($categories))) {
                $categories[$item->category->key] = [
                    'label' => $item->category->key,
                    'borderColor' => catColor($item->category->key),
                    'backgroundColor' => catColor($item->category->key),
                    'data' => [(float)$item->capacity * (float)resourceIntensityRTE($item->category->key, $resource)]
                ];
            }
        }

        foreach ($items as $item) {
            array_push($categories[$item->category->name]['data'], (float)$item->capacity * (float)resourceIntensityRTE($item->category->key, $resource));
        }

        $labels = Scenario::get()->pluck('name')->toArray();
        $labels = array_merge(['Référence (2020)'], $labels);

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
                            'text' => $resource == 'space' ? 'ha' : 'T'
                        ]
                    ],
                    'x' => [
                        'stacked' => true,
                    ]
                ]
            ]
        ];

        return view('impacts.show', [
            'year' => $this->year,
            'resource' => $resource,
            'jsonConfig' => json_encode($config),
            'resources' => resources()
        ]);
    }
}
