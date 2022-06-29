<?php

function catIcon(string $category): string
{
    $icons = [
        'metawatt' => 'fa-bolt text-warning',
        'nuc' => 'fa-atom text-success',
        'hydro' => 'fa-water text-primary',
        'wind' => 'fa-wind text-secondary',
        'gas' => 'fa-fire-flame-simple text-success',
        'sun' => 'fa-solar-panel text-warning',
        'hydrowind' => 'fa-fan text-info',
        'coal' => 'fa-leaf text-danger',
        'methane' => 'fa-fire-flame-curved text-warning',
        'h2' => 'fa-heading text-info',
        'oil' => 'fa-gas-pump text-danger',
    ];

    return (array_key_exists($category, $icons))
        ? $icons[$category]
        : 'fa-bolt';
}

function typeName(string $type): string
{
    $types = [
        'capacity' => 'Capacité',
        'production' => 'Production'
    ];

    return (array_key_exists($type, $types))
        ? $types[$type]
        : 'Capacité';
}

function catColor(string $category): string
{
    $colors = [
        'nuc' => '#28a745',
        'hydro' => '#2196F3',
        'wind' => '#CDDC39',
        'gas' => '#ff5722',
        'sun' => '#FDD835',
        'hydrowind' => '#00bcd4',
        'coal' => '#607d8b',
        'methane' => '#009688',
        'h2' => '#9C27B0',
        'oil' => '#795548',
    ];

    return (array_key_exists($category, $colors))
        ? $colors[$category]
        : 'white';
}

function catName(string $category): string
{
    $names = [
        'nuc' => 'Nucléaire',
        'hydro' => 'Hydraulique',
        'wind' => 'Éolien',
        'gas' => 'Gas',
        'sun' => 'Photovoltaïque',
        'hydrowind' => 'Hydrolien',
        'coal' => 'Charbon',
        'methane' => 'Méthane',
        'h2' => 'Hydrogène',
        'oil' => 'Pétrole',
    ];

    return (array_key_exists($category, $names))
        ? $names[$category]
        : 'Catégorie';
}
