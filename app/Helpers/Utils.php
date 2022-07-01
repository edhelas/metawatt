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

function resourceIntensityRTE(string $category, string $resource): float
{
    // Annexes 12-3
    $intensity = [
        'copper' => [
            'nuc'       => 1.6,
            'hydro'     => 0.18,
            'wind'      => 2.6,
            'gas'       => 1.2, // combiné, combustion: 0.79
            'sun'       => 3.1,
            'hydrowind' => 8.5,
            'coal'      => 0.79,
            'methane'   => 0,
            'h2'        => 0,
            'oil'       => 0.79,
        ],
        'steel' => [
            'nuc'       => 67,
            'hydro'     => 98,
            'wind'      => 200,
            'gas'       => 29, // combiné, combustion:6.3
            'sun'       => 23, // mediane PV sol-toiture
            'hydrowind' => 320, // mediane posé-flottant
            'coal'      => 6.3,
            'methane'   => 0,
            'h2'        => 0,
            'oil'       => 6.3,
        ],
        'concrete' => [
            'nuc'       => 533,
            'hydro'     => 21,
            'wind'      => 450,
            'gas'       => 36, // combiné, combustion:6.3
            'sun'       => 32, // mediane PV sol-toiture
            'hydrowind' => 1300, // mediane posé-flottant
            'coal'      => 41,
            'methane'   => 0,
            'h2'        => 0,
            'oil'       => 41,
        ],
    ];

    if (array_key_exists($resource, $intensity) && array_key_exists($category, $intensity[$resource])) {
        return $intensity[$resource][$category];
    }

    return 0;
}

function resources(): array
{
    return [
        'copper' => 'Cuivre',
        'concrete' => 'Béton',
        'steel' => 'Acier',
    ];
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
