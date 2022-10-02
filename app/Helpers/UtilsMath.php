<?php

function loadFactor(float $capacity, float $production): int
{
    if ($capacity == 0) return 0;

    return (int) ($production * 1000 * 100) / ($capacity * 365 * 24);
}

function capacityToProduction(float $capacity): float
{
    return ($capacity * 365 * 24) / 1000;
}

// Calculated from the capacity and production in 2050
// production*1000/365/24*100/capacity
function ademeLoadFactor(string $category): float
{
    $names = [
        'nuc' => 0.7686,
        'hydro' => 0.2338,
        'wind' => 0.3165,
        'sun' => 0.1466,
        'hydrowind' => 0.4142,
    ];

    return (array_key_exists($category, $names))
        ? $names[$category]
        : 0;
}

function compareParis(float $space): float
{
    return round(($space / 10540), 2);
}

function compareCarbon2021(int $carbon): float
{
    return round($carbon / 58, 1);
}

function percentage(float $value, float $total, int $precision = 1)
{
    return round($value * 100 / $total, $precision);
}