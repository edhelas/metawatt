<?php

use League\CommonMark\CommonMarkConverter;

function catIcon(string $category): string
{
    $icons = [
        'metawatt' => 'fa-bolt text-warning',
        'nuc' => 'fa-atom',
        'newnuc' => 'fa-atom',
        'hydro' => 'fa-water',
        'step' => 'fa-battery-full',
        'wind' => 'fa-wind',
        'gas' => 'fa-fire-flame-simple',
        'sun' => 'fa-solar-panel',
        'hydrowind' => 'fa-fan',
        'coal' => 'fa-leaf',
        'h2' => 'fa-heading',
        'oil' => 'fa-gas-pump',
        'tidal' => 'fa-water',
        'biomass' => 'fa-tree',
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
        'ademe' => 'L’ADEME a souhaité soumettre au débat quatre chemins “types” cohérents (dont un avec deux variantes) qui présentent de manière volontairement contrastée des options économiques, techniques et de société pour atteindre la neutralité carbone en 2050.

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
        'belfort' => [],
        'nw' => [
            'https://negawatt.org/Scenario-negaWatt-2017-2050' => 'Scénario négaWatt 2017',
            'https://negawatt.org/Scenario-negaWatt-2022' => 'Scénario négaWatt 2022',
        ],
        'ademe' => [
            'https://librairie.ademe.fr/energies-renouvelables-reseaux-et-stockage/5352-prospective-transitions-2050-feuilleton-mix-electrique.html' => 'ADEME - La Librairie: Prospective - Transitions 2050 - Feuilleton Mix électrique'
        ],
    ];

    return (array_key_exists($group, $groups))
        ? $groups[$group]
        : [];
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
        'ademe' => '#4caf50',
    ];

    return (array_key_exists($group, $groups))
        ? $groups[$group]
        : 'white';
}

function catColor(string $category): string
{
    // Reuse RTE color chart
    $colors = [
        'nuc' => 'rgb(245, 179, 0)',
        'newnuc' => 'rgb(249, 193, 37)',
        'hydro' => 'rgb(39, 114, 178)',
        'step' => 'rgb(107, 144, 176)',
        'wind' => 'rgb(116, 205, 185)',
        'gas' => 'rgb(243, 10, 10)',
        'sun' => 'rgb(242, 116, 6)',
        'hydrowind' => 'rgb(130, 205, 200)',
        'coal' => 'rgb(172, 140, 53)',
        'h2' => '#00bcd4',
        'oil' => 'rgb(131, 146, 162)',
        'tidal' => '#03a9f4',
        'biomass' => 'rgb(22, 106, 87)',
    ];

    return (array_key_exists($category, $colors))
        ? $colors[$category]
        : 'white';
}

function catName(string $category): string
{
    $names = [
        'nuc' => 'Nucléaire',
        'newnuc' => 'Nouveau nucléaire',
        'hydro' => 'Hydraulique',
        'step' => 'STEP',
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
