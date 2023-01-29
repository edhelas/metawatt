<?php

function loadFactor(float $capacity, float $production): int
{
    if ($capacity == 0) return 0;

    return (int) ($production * 1000 * 100) / ($capacity * 365 * 24);
}

function compareParis(float $space): float
{
    return round(($space / 10540), 2);
}

function sobrietyPercentage(float $energy): float
{
    // https://www.statistiques.developpement-durable.gouv.fr/edition-numerique/chiffres-cles-energie-2021/6-bilan-energetique-de-la-france
    return -(100 - round($energy * 100 / 1562, 1));
}

function compareCarbon2021(int $carbon): float
{
    return round($carbon * 100 / 58, 1);
}

function percentage(float $value, float $total, int $precision = 1)
{
    return round($value * 100 / $total, $precision);
}