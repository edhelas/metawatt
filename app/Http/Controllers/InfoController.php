<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InfoController extends Controller
{
    public function discover(Request $request)
    {
        $configCapacity = [
            'type' => 'doughnut',
            'data' => [
                'labels' => ['Énergie', 'Industrie & Construction', 'Déchets', 'Usage des bâtiments', 'Agriculture', 'Transport routier', 'Autres transports'],
                'datasets' => [
                    [
                        'label' => 'mTeqCO2',
                        'data' => [43.8, 77.8, 14.5, 74.9, 81.2, 119.6, 6.4],
                        'backgroundColor' => ['#28a745', '#2196F3', '#9C27B0', '#ff5722', '#FDD835', '#795548', '#009688'],
                        'borderColor' => 'transparent',
                    ]
                ]
            ],
            'options' => [
                'plugins' => [
                    'legend' => ['position' => 'left'],
                    'datalabels' => [
                        'backgroundColor' => '#191d21',
                        'color' => 'white',
                        'borderRadius' => 5
                    ]
                ]
            ]
        ];

        return view('info.discover', [
            'withDataLabel' => true,
            'jsonConfig' => json_encode($configCapacity)
        ]);
    }
}
