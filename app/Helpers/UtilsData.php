<?php

/**
 * Here we assume that newnuc = new and hydro = step for the carbon and resource intensity
 */

function carbonIntensity(string $category): float
{
    // Source ElectricityMap, November 2022
    $intensity =  [
        'nuc'       => 5, // UNECE 2022
        'newnuc'    => 5, // UNECE 2022
        'hydro'     => 11,
        'step'      => 11,
        'wind'      => 13,
        'gas'       => 625,
        'sun'       => 30,
        'hydrowind' => 13,
        'coal'      => 954,
        'tidal'     => 0, // To be found
        'h2'        => 0,
        'oil'       => 1014,
        'biomass'   => 230,
    ];

    if (array_key_exists($category, $intensity)) {
        return $intensity[$category];
    }

    return 0;
}

function renewable(): array
{
    return [
        'hydro',
        'wind',
        'sun',
        'hydrowind',
        'tidal',
        'biomass',
    ];
}

function storage(): array
{
    return [
        'step',
        'battery',
        'h2'
    ];
}

function lowCarbon(): array
{
    return [
        'step',
        'nuc',
        'newnuc',
        'wind',
        'sun',
        'hydro',
        'hydrowind',
        'tidal',
    ];
}

/**
 * https://www.iea.org/data-and-statistics/charts/minerals-used-in-clean-energy-technologies-compared-to-other-power-generation-sources
 */
function resourceIntensityIEA(string $category, string $resource): float
{
    $intensity = [
        'copper' => [
            'nuc'       => 1.473,
            'newnuc'    => 1.473,
            'hydro'     => 0.01, // RTE see bellow
            'step'      => 0.01, // RTE see bellow
            'wind'      => 2,9,
            'gas'       => 1.1,
            'sun'       => 2.822,
            'hydrowind' => 8,
            'coal'      => 1.150,
            'h2'        => 0,
            'tidal'     => 0,
            'oil'       => 0
        ],
        'nickel' => [
            'nuc'       => 1.297,
            'newnuc'    => 1.297,
            'hydro'     => 0.00,
            'step'      => 0.00,
            'wind'      => 0.403,
            'gas'       => 0.15,
            'sun'       => 0,
            'hydrowind' => 0.24,
            'coal'      => 0.721,
            'h2'        => 0,
            'tidal'     => 0,
            'oil'       => 0,
        ],
        'manganese' => [
            'nuc'       => 0.147,
            'newnuc'    => 0.147,
            'hydro'     => 0,
            'step'      => 0,
            'wind'      => 0.780,
            'gas'       => 0,
            'sun'       => 0,
            'hydrowind' => 0.790,
            'coal'      => 0,
            'h2'        => 0,
            'tidal'     => 0,
            'oil'       => 0,
        ],
        'chrome' => [
            'nuc'       => 2.19,
            'newnuc'    => 2.19,
            'hydro'     => 0,
            'step'      => 0,
            'wind'      => 0.470,
            'gas'       => 0.0483,
            'sun'       => 0,
            'hydrowind' => 0.525,
            'coal'      => 0.3075,
            'h2'        => 0,
            'tidal'     => 0,
            'oil'       => 0,
        ],
        'zinc' => [
            'nuc'       => 0,
            'newnuc'    => 0,
            'hydro'     => 0,
            'step'      => 0,
            'wind'      => 5.5,
            'gas'       => 0,
            'sun'       => 0.030,
            'hydrowind' => 5.5,
            'coal'      => 0,
            'h2'        => 0,
            'tidal'     => 0,
            'oil'       => 0,
        ],
        'molybdenum' => [
            'nuc'       => 2.19,
            'newnuc'    => 2.19,
            'hydro'     => 0,
            'step'      => 0,
            'wind'      => 0.470,
            'gas'       => 0.0483,
            'sun'       => 0,
            'hydrowind' => 0.525,
            'coal'      => 0.3075,
            'h2'        => 0,
            'tidal'     => 0,
            'oil'       => 0,
        ],
    ];

    if (
        array_key_exists($resource, $intensity)
        && array_key_exists($category, $intensity[$resource])
    ) {
        return $intensity[$resource][$category];
    }

    return 0;
}

function resourceIntensityRTE(string $category, string $resource, ?int $year = null): float
{
    $intensity = [
        // Annexes 12-4
        'space' => [
            'nuc'       => 0.06,
            'newnuc'    => 0.06,
            'hydro'     => 0.01,
            'step'      => 0.01,
            'wind'      => 0.15,
            'gas'       => 0.02,
            'sun'       => 0.07, // moyenne sol 0.10 toiture 0.05
            'hydrowind' => 0.0,
            'coal'      => 0.02,
            'h2'        => 0,
            'tidal'     => 0, // To be found
            'oil'       => 0.02,

            2030 => [ // /!\ Extrapolated between 2020 and 2050
                'nuc'       => 0.05,
                'newnuc'    => 0.05,
                'hydro'     => 0.01,
                'step'      => 0.01,
                'wind'      => 0.15,
                'gas'       => 0.02,
                'sun'       => 0.07, // moyenne sol 0.10 toiture 0.05
                'hydrowind' => 0.0,
                'coal'      => 0.02,
                'h2'        => 0,
                'tidal'     => 0, // To be found
                'oil'       => 0.02,
            ],

            2040 => [ // /!\ Extrapolated between 2020 and 2050
                'nuc'       => 0.04,
                'newnuc'    => 0.04,
                'hydro'     => 0.01,
                'step'      => 0.01,
                'wind'      => 0.15,
                'gas'       => 0.02,
                'sun'       => 0.07, // moyenne sol 0.10 toiture 0.05
                'hydrowind' => 0.0,
                'coal'      => 0.02,
                'h2'        => 0,
                'tidal'     => 0, // To be found
                'oil'       => 0.02,
            ],

            2050 => [
                'nuc'       => 0.03,
                'newnuc'    => 0.03,
                'hydro'     => 0.01,
                'step'      => 0.01,
                'wind'      => 0.15,
                'gas'       => 0.02,
                'sun'       => 0.07, // moyenne sol 0.10 toiture 0.05
                'hydrowind' => 0.0,
                'coal'      => 0.02,
                'h2'        => 0,
                'tidal'     => 0, // To be found
                'oil'       => 0.02,
            ]
        ],

        // Annexes 12-3
        'copper' => [
            'nuc'       => 1.6,
            'newnuc'    => 1.6,
            'hydro'     => 0.18,
            'step'      => 0.18,
            'wind'      => 2.6,
            'gas'       => 1.2, // combiné, combustion: 0.79
            'sun'       => 3.4,
            'hydrowind' => 8.5,
            'coal'      => 0.79,
            'h2'        => 0,
            'tidal'     => 0, // To be found
            'oil'       => 0.79,

            2030 => [
                'nuc'       => 1.6,
                'newnuc'    => 1.6,
                'hydro'     => 0.18,
                'step'      => 0.18,
                'wind'      => 2.6,
                'gas'       => 1.2, // combiné, combustion: 0.79
                'sun'       => 3.4,
                'hydrowind' => 8.5,
                'coal'      => 0.79,
                'h2'        => 0,
                'tidal'     => 0, // To be found
                'oil'       => 0.79,
            ],
            2040 => [
                'nuc'       => 1.6,
                'newnuc'    => 1.6,
                'hydro'     => 0.18,
                'step'      => 0.18,
                'wind'      => 2.6,
                'gas'       => 1.2, // combiné, combustion: 0.79
                'sun'       => 3.2,
                'hydrowind' => 8.5,
                'coal'      => 0.79,
                'h2'        => 0,
                'tidal'     => 0, // To be found
                'oil'       => 0.79,
            ],
            2050 => [
                'nuc'       => 1.6,
                'newnuc'    => 1.6,
                'hydro'     => 0.18,
                'step'      => 0.18,
                'wind'      => 2.6,
                'gas'       => 1.2, // combiné, combustion: 0.79
                'sun'       => 3.1,
                'hydrowind' => 8.5,
                'coal'      => 0.79,
                'h2'        => 0,
                'tidal'     => 0, // To be found
                'oil'       => 0.79,
            ]
        ],
        'steel' => [
            'nuc'       => 67,
            'newnuc'    => 67,
            'hydro'     => 98,
            'step'      => 98,
            'wind'      => 200,
            'gas'       => 29, // combiné, combustion:6.3
            'sun'       => 34,5, // mediane PV sol-toiture
            'hydrowind' => 320, // mediane posé-flottant
            'coal'      => 6.3,
            'h2'        => 0,
            'tidal'     => 0, // To be found
            'oil'       => 6.3,

            2030 => [
                'nuc'       => 67,
                'newnuc'    => 67,
                'hydro'     => 98,
                'step'      => 98,
                'wind'      => 200,
                'gas'       => 29, // combiné, combustion:6.3
                'sun'       => 29,4, // mediane PV sol-toiture
                'hydrowind' => 320, // mediane posé-flottant
                'coal'      => 6.3,
                'h2'        => 0,
                'tidal'     => 0, // To be found
                'oil'       => 6.3,
            ],
            2040 => [
                'nuc'       => 67,
                'newnuc'    => 67,
                'hydro'     => 98,
                'step'      => 98,
                'wind'      => 200,
                'gas'       => 29, // combiné, combustion:6.3
                'sun'       => 24,3, // mediane PV sol-toiture
                'hydrowind' => 320, // mediane posé-flottant
                'coal'      => 6.3,
                'h2'        => 0,
                'tidal'     => 0, // To be found
                'oil'       => 6.3,
            ],
            2050 => [
                'nuc'       => 67,
                'newnuc'    => 67,
                'hydro'     => 98,
                'wind'      => 200,
                'gas'       => 29, // combiné, combustion:6.3
                'sun'       => 23, // mediane PV sol-toiture
                'hydrowind' => 320, // mediane posé-flottant
                'coal'      => 6.3,
                'h2'        => 0,
                'tidal'     => 0, // To be found
                'oil'       => 6.3,
            ]
        ],
        'concrete' => [
            'nuc'       => 533,
            'newnuc'    => 533,
            'hydro'     => 21,
            'step'      => 21,
            'wind'      => 450,
            'gas'       => 36, // combiné, combustion:6.3
            'sun'       => 51, // mediane PV sol-toiture
            'hydrowind' => 1300, // mediane posé-flottant
            'coal'      => 41,
            'h2'        => 0,
            'tidal'     => 0, // To be found
            'oil'       => 41,

            2030 => [
                'nuc'       => 533,
                'newnuc'    => 533,
                'hydro'     => 21,
                'step'      => 21,
                'wind'      => 450,
                'gas'       => 36, // combiné, combustion:6.3
                'sun'       => 43, // mediane PV sol-toiture
                'hydrowind' => 1300, // mediane posé-flottant
                'coal'      => 41,
                'h2'        => 0,
                'tidal'     => 0, // To be found
                'oil'       => 41,
            ],
            2040 => [
                'nuc'       => 533,
                'newnuc'    => 533,
                'hydro'     => 21,
                'step'      => 21,
                'wind'      => 450,
                'gas'       => 36, // combiné, combustion:6.3
                'sun'       => 36, // mediane PV sol-toiture
                'hydrowind' => 1300, // mediane posé-flottant
                'coal'      => 41,
                'h2'        => 0,
                'tidal'     => 0, // To be found
                'oil'       => 41,
            ],
            2050 => [
                'nuc'       => 533,
                'newnuc'    => 533,
                'hydro'     => 21,
                'step'      => 21,
                'wind'      => 450,
                'gas'       => 36, // combiné, combustion:6.3
                'sun'       => 32, // mediane PV sol-toiture
                'hydrowind' => 1300, // mediane posé-flottant
                'coal'      => 41,
                'h2'        => 0,
                'tidal'     => 0, // To be found
                'oil'       => 41,
            ]
        ],
        'aluminium' => [
            'nuc'       => 0.35,
            'newnuc'    => 0.35,
            'hydro'     => 0.52,
            'step'      => 0.52,
            'wind'      => 1,
            'gas'       => 1.1, // combiné, combustion:6.3
            'sun'       => 25, // mediane PV sol-toiture
            'hydrowind' => 1.05, // mediane posé-flottant
            'coal'      => 0.75,
            'h2'        => 0,
            'tidal'     => 0, // To be found
            'oil'       => 0.75,

            2030 => [
                'nuc'       => 0.35,
                'newnuc'    => 0.35,
                'hydro'     => 0.52,
                'step'      => 0.52,
                'wind'      => 0.69,
                'gas'       => 1.1, // combiné, combustion:6.3
                'sun'       => 20, 55, // mediane PV sol-toiture
                'hydrowind' => 1.075, // mediane posé-flottant
                'coal'      => 0.75,
                'h2'        => 0,
                'tidal'     => 0, // To be found
                'oil'       => 0.75,
            ],
            2040 => [
                'nuc'       => 0.35,
                'newnuc'    => 0.35,
                'hydro'     => 0.52,
                'step'      => 0.52,
                'wind'      => 0.69,
                'gas'       => 1.1, // combiné, combustion:6.3
                'sun'       => 16, 66, // mediane PV sol-toiture
                'hydrowind' => 1.075, // mediane posé-flottant
                'coal'      => 0.75,
                'h2'        => 0,
                'tidal'     => 0, // To be found
                'oil'       => 0.75,
            ],
            2050 => [
                'nuc'       => 0.35,
                'newnuc'    => 0.35,
                'hydro'     => 0.52,
                'step'      => 0.52,
                'wind'      => 0.69,
                'gas'       => 1.1, // combiné, combustion:6.3
                'sun'       => 14, 7, // mediane PV sol-toiture
                'hydrowind' => 1.075, // mediane posé-flottant
                'coal'      => 0.75,
                'h2'        => 0,
                'tidal'     => 0, // To be found
                'oil'       => 0.75,
            ]
        ],
    ];

    if (
        $year != null
        && array_key_exists($resource, $intensity)
        && array_key_exists($year, $intensity[$resource])
        && array_key_exists($category, $intensity[$resource][$year])
    ) {
        return $intensity[$resource][$year][$category];
    } elseif (
        array_key_exists($resource, $intensity)
        && array_key_exists($category, $intensity[$resource])
    ) {
        return $intensity[$resource][$category];
    }

    return 0;
}
