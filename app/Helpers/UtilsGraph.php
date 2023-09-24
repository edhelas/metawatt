<?php

use Illuminate\Support\Collection;

function scenarioBaseConfig($scenario, string $label = '', bool $hidden = false): array
{
    return [
        'label' => $scenario->name . ' ' . $label,
        'tension' => 0.3,
        'hitRadius' => 4,
        'pointRadius' => 6,
        'pointStyle' => scenarioPointSyle($scenario),
        'hidden' => $hidden,
        'borderColor' => groupColor($scenario->group, $scenario->slug),
        'data' => []
    ];
}

function scenarioPointSyle($scenario): string
{
    switch ($scenario->group) {
        case 'ademe':
            return 'rect';
            break;

        case 'rte':
            return 'triangle';
            break;

        case 'rte_2035':
            return 'rectRot';
            break;

        case 'nw':
            return 'circle';
            break;

        case 'vdn':
            return 'star';
            break;
    }
}

function getYears(): Collection
{
    return collect([2020, 2025, 2030, 2035, 2040, 2045, 2050, 2055, 2060]);
}

function getDataLabels(): array
{
    $dataLabels = [];
    getYears()->each(function ($item) use (&$dataLabels) {
        $dataLabels[$item] = null;
    });

    return $dataLabels;
}