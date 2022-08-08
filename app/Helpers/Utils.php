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
        'biomass' => 'fa-tree text-success',
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

function groupName(string $group): string
{
    $groups = [
        'rte' => 'RTE',
        'belfort' => 'Belfort',
        'nw' => 'negaWatt'
    ];

    return (array_key_exists($group, $groups))
        ? $groups[$group]
        : 'Groupe';
}

function groupNameSecond(string $group): string
{
    $groups = [
        'rte' => 'Futurs énergétiques 2050',
        'belfort' => 'Scénarios du discours de Belfort',
        'nw' => 'Scénarios negaWatt'
    ];

    return (array_key_exists($group, $groups))
        ? $groups[$group]
        : 'Groupe';
}

function carbonIntensity(string $category): float
{
    // IPCC 2014
    $intensity =  [
        'nuc'       => 4, // EDF 2022
        'hydro'     => 24,
        'wind'      => 11,
        'gas'       => 490,
        'sun'       => 45,
        'hydrowind' => 11,
        'coal'      => 820,
        'methane'   => 0,
        'h2'        => 0,
        'oil'       => 650,
        'biomass'   => 230,
    ];

    // Autre chiffres RTE 12-2 ACV_GES

    if (array_key_exists($category, $intensity)) {
        return $intensity[$category]*1000;
    }

    return 0;
}

function resourceIntensityRTE(string $category, string $resource): float
{
    $intensity = [
        // Annexes 12-4
        'space' => [
            'nuc'       => 0.06,
            'hydro'     => 0.01,
            'wind'      => 0.15,
            'gas'       => 0.02,
            'sun'       => 0.05, // moyenne sol 0.10 toiture 0.05
            'hydrowind' => 0.0,
            'coal'      => 0.02,
            'h2'        => 0,
            'oil'       => 0.02,
        ],

        // Annexes 12-3
        'copper' => [
            'nuc'       => 1.6,
            'hydro'     => 0.18,
            'wind'      => 2.6,
            'gas'       => 1.2, // combiné, combustion: 0.79
            'sun'       => 3.1,
            'hydrowind' => 8.5,
            'coal'      => 0.79,
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
            'h2'        => 0,
            'oil'       => 41,
        ],
        'aluminium' => [
            'nuc'       => 0.35,
            'hydro'     => 0.52,
            'wind'      => 1,
            'gas'       => 1.1, // combiné, combustion:6.3
            'sun'       => 25, // mediane PV sol-toiture
            'hydrowind' => 1.05, // mediane posé-flottant
            'coal'      => 0.75,
            'h2'        => 0,
            'oil'       => 0.75,
        ],
    ];

    if (array_key_exists($resource, $intensity) && array_key_exists($category, $intensity[$resource])) {
        return $intensity[$resource][$category]*1000;
    }

    return 0;
}

function resources(): array
{
    return [
        'copper' => 'Cuivre',
        'concrete' => 'Béton',
        'steel' => 'Acier',
        'aluminium' => 'Aluminium',
        'space' => 'Artificialisation',
    ];
}

function groupColor(string $group): string
{
    $groups = [
        'belfort' => '#28a745',
        'rte' => '#2196F3',
        'nw' => '#009688',
    ];

    return (array_key_exists($group, $groups))
        ? $groups[$group]
        : 'white';
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
        'h2' => '#9C27B0',
        'oil' => '#795548',
        'biomass' => '#009688',
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
        'hydrowind' => 'Éolien marin',
        'coal' => 'Charbon',
        'h2' => 'Hydrogène',
        'oil' => 'Pétrole',
        'biomass' => 'Biomasse',
    ];

    return (array_key_exists($category, $names))
        ? $names[$category]
        : 'Catégorie';
}
