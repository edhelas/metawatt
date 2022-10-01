<?php

function scenarioBaseConfig($scenario): array
{
    return [
        'label' => $scenario->name,
        'tension' => 0.3,
        'hitRadius' => 4,
        'pointRadius' => 6,
        'borderColor' => groupColor($scenario->group),
        'data' => []
    ];
}