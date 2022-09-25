<?php

use League\CommonMark\CommonMarkConverter;

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
        'h2' => 'fa-heading text-info',
        'oil' => 'fa-gas-pump text-danger',
        'tidal' => 'fa-water text-info',
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
        'nw' => 'negaWatt',
        'ademe' => 'ADEME',
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
        'nw' => 'Scénarios negaWatt',
        'ademe' => 'Transition(s) 2050',
    ];

    return (array_key_exists($group, $groups))
        ? $groups[$group]
        : 'Groupe';
}

function groupLogo(string $group): string
{
    $groups = [
        'rte' => 'rte.svg',
        'nw' => 'negawatt.jpg',
        'ademe' => 'ademe.svg',
    ];

    return (array_key_exists($group, $groups))
        ? '/img/' . $groups[$group]
        : '';
}

function groupIntroduction(string $group): string
{
    $groups = [
        'rte' => 'En 2019, RTE a lancé une large étude sur l’évolution du système électrique intitulée « Futurs énergétiques 2050 ».

Cette étude implique une démarche inédite en matière de concertation et de transparence impliquant les parties prenantes intéressées à tous les stades de construction des scénarios, jusqu’à la publication des principaux résultats à l’automne 2021 et de leur analyse complète en février 2022.',
        'belfort' => 'Pierrick Dartois et Marie Suderie ont publié à l’été 2022 leur mémoire de fin de formation du Corps des ingénieurs des Mines.

Leur publication examine les conséquences sur le système électrique d’un mix intégrant du nucléaire et une part importante d’énergies renouvelables selon les orientations formulées par Emmanuel MACRON à Belfort le 10 février 2022.',
        'nw' => 'L’association negaWatt publie depuis plusieurs année des scénarios de transition énergétique.

Partant du principe que l’énergie la moins polluante est celle qu’on ne consomme/produit pas, négaWatt propose de repenser notre vision de l’énergie en s’appuyant sur une démarche en trois étapes: sobriété, efficacité énergétique et énergies renouvelables.',
        'ademe' => 'L’ADEME a souhaité soumettre au débat quatre chemins “types” cohérents qui présentent de manière volontairement contrastée des options économiques, techniques et de société pour atteindre la neutralité carbone en 2050.

Imaginés pour la France métropolitaine, ils reposent sur les mêmes données macroéconomiques, démographiques et d’évolution climatique (+2,1°C en 2100). Cependant, ils empruntent des voies distinctes et correspondent à des choix de société différents.',
    ];



    return (array_key_exists($group, $groups))
        ? markdown($groups[$group])
        : '';
}

function markdown(string $string)
{
    $converter = new CommonMarkConverter([
        'html_input' => 'strip',
        'allow_unsafe_links' => false,
    ]);

    return $converter->convert($string);
}

function groupSources(string $group): array
{
    $groups = [
        'rte' => [
            'https://www.rte-france.com/analyses-tendances-et-prospectives/bilan-previsionnel-2050-futurs-energetiques#Lesdonnees' => 'Futurs énergétiques 2050: Les données'
        ],
        'belfort' => [

        ],
        'nw' => [
            'https://negawatt.org/Scenario-negaWatt-2017-2050' => 'Scénario négaWatt 2017'
        ],
        'ademe' => [
            'https://librairie.ademe.fr/energies-renouvelables-reseaux-et-stockage/5352-prospective-transitions-2050-feuilleton-mix-electrique.html' => 'ADEME - La Librairie: Prospective - Transitions 2050 - Feuilleton Mix électrique'
        ],
    ];

    return (array_key_exists($group, $groups))
        ? $groups[$group]
        : [];
}

function carbonIntensity(string $category): float
{
    // IPCC 2014 en gCO2eq/kWh
    $intensity =  [
        'nuc'       => 4, // EDF 2022
        'hydro'     => 24,
        'wind'      => 11,
        'gas'       => 490,
        'sun'       => 45,
        'hydrowind' => 11,
        'coal'      => 820,
        'tidal'     => 0, // To be found
        'h2'        => 0,
        'oil'       => 650,
        'biomass'   => 230,
    ];

    // Autre chiffres RTE 12-2 ACV_GES

    if (array_key_exists($category, $intensity)) {
        return $intensity[$category];
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
            'sun'       => 0.07, // moyenne sol 0.10 toiture 0.05
            'hydrowind' => 0.0,
            'coal'      => 0.02,
            'h2'        => 0,
            'tidal'     => 0, // To be found
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
            'tidal'     => 0, // To be found
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
            'tidal'     => 0, // To be found
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
            'tidal'     => 0, // To be found
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
            'tidal'     => 0, // To be found
            'oil'       => 0.75,
        ],
    ];

    if (array_key_exists($resource, $intensity) && array_key_exists($category, $intensity[$resource])) {
        return $intensity[$resource][$category];
    }

    return 0;
}

function compareParis(float $space): float
{
    return round(($space / 10540), 2);
}

function compareCarbon2021(int $carbon): float
{
    return round($carbon / 58, 1);
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
        'nw' => '#ff5722',
        'ademe' => '#FF9800',
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
        'hydrowind' => '#9C27B0',
        'coal' => '#607d8b',
        'h2' => '#00bcd4',
        'oil' => '#795548',
        'tidal' => '#03a9f4',
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
        'gas' => 'Gas fossile',
        'sun' => 'Photovoltaïque',
        'hydrowind' => 'Éolien marin',
        'coal' => 'Charbon',
        'h2' => 'Hydrogène',
        'oil' => 'Pétrole',
        'tidal' => 'Hydrolien',
        'biomass' => 'Biomasse',
    ];

    return (array_key_exists($category, $names))
        ? $names[$category]
        : 'Catégorie';
}

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