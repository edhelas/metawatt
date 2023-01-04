<?php

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

        case 'nw':
            return 'circle';
            break;

        case 'vdn':
            return 'star';
            break;
    }
}