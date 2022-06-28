// Numbers ending with a . are extrapolated from graphs
/**
 * RTE GW -> TWh
 *   sun: 1,22
 */
 const labels = [
    '2010',
    '2020',
    '2030',
    '2040',
    '2050',
];

 const data = {
    labels: labels,
    datasets: [
        {
            group: 'coal',
            set: 'nw',
            label: 'Charbon (2011)',
            data: [151, 82, 50, 28, 13],
            tension: 0.3
        },
        {
            group: 'coal',
            set: 'nw',
            label: 'Charbon (2017)',
            data: [124, 47, 19, 7, 3],
            tension: 0.3
        },
        {
            group: 'coal',
            set: 'nw',
            label: 'Charbon (2022)',
            data: [null, 75, 27, 4, 0],
            tension: 0.3
        },
        {
            group: 'wind',
            set: 'rte',
            label: 'Eolien (M0)',
            data: [null, 40.7, null, null, 373],
            tension: 0.3
        },
        {
            group: 'wind',
            set: 'rte',
            label: 'Eolien (M1)',
            data: [null, 40.7, null, null, 281],
            tension: 0.3
        },
        {
            group: 'wind',
            set: 'rte',
            label: 'Eolien (M23)',
            data: [null, 40.7, null, null, 360],
            tension: 0.3
        },
        {
            group: 'wind',
            set: 'rte',
            label: 'Eolien (N1)',
            data: [null, 40.7, null, null, 277],
            tension: 0.3
        },
        {
            group: 'wind',
            set: 'rte',
            label: 'Eolien (N2)',
            data: [null, 40.7, null, null, 233],
            tension: 0.3
        },
        {
            group: 'wind',
            set: 'rte',
            label: 'Eolien (N03)',
            data: [null, 40.7, null, null, 165],
            tension: 0.3
        },
        {
            group: 'wind',
            set: 'ademe',
            label: 'Eolien (S1)',
            data: [null, 40.7, null, null, 210.3],
            tension: 0.3
        },
        {
            group: 'wind',
            set: 'ademe',
            label: 'Eolien (S2)',
            data: [null, 40.7, null, null, 255.7],
            tension: 0.3
        },
        {
            group: 'wind',
            set: 'ademe',
            label: 'Eolien (S3ENR)',
            data: [null, 40.7, null, null, 327.6],
            tension: 0.3
        },
        {
            group: 'wind',
            set: 'ademe',
            label: 'Eolien (S3Nuc)',
            data: [null, 40.7, null, null, 240.3],
            tension: 0.3
        },
        {
            group: 'wind',
            set: 'ademe',
            label: 'Eolien (S4)',
            data: [null, 40.7, null, null, 341.3],
            tension: 0.3
        },
        {
            group: 'wind',
            set: 'nw',
            label: 'Eolien (2011)',
            data: [10, 41, 115, 179, 209],
            tension: 0.3
        },
        {
            group: 'wind',
            set: 'nw',
            label: 'Eolien (2017)',
            data: [10, 34, 123, 219, 247],
            tension: 0.3
        },
        {
            group: 'wind',
            set: 'nw',
            label: 'Eolien (2022)',
            data: [null, 40, 114, 231, 305],
            tension: 0.3
        },
        {
            group: 'sun',
            set: 'rte',
            label: 'Photovoltaïque (M0)',
            data: [null, 13.6, 61., 153., 255],
            tension: 0.3
        },
        {
            group: 'sun',
            set: 'rte',
            label: 'Photovoltaïque (M1)',
            data: [null, 13.6, 31., 153., 255],
            tension: 0.3
        },
        {
            group: 'sun',
            set: 'rte',
            label: 'Photovoltaïque (M23)',
            data: [null, 13.6, 37., 98., 153],
            tension: 0.3
        },
        {
            group: 'sun',
            set: 'rte',
            label: 'Photovoltaïque (N1)',
            data: [null, 13.6, 49., 98., 144],
            tension: 0.3
        },
        {
            group: 'sun',
            set: 'rte',
            label: 'Photovoltaïque (N2)',
            data: [null, 13.6, 37., 74., 110],
            tension: 0.3
        },
        {
            group: 'sun',
            set: 'rte',
            label: 'Photovoltaïque (N03)',
            data: [null, 13.6, 49., 67., 86],
            tension: 0.3
        },
        {
            group: 'sun',
            set: 'ademe',
            label: 'Photovoltaïque (S1)',
            data: [null, 13.6, null, null, 118.2],
            tension: 0.3
        },
        {
            group: 'sun',
            set: 'ademe',
            label: 'Photovoltaïque (S2)',
            data: [null, 13.6, null, null, 123.5],
            tension: 0.3
        },
        {
            group: 'sun',
            set: 'ademe',
            label: 'Photovoltaïque (S3ENR)',
            data: [null, 13.6, null, null, 176.3],
            tension: 0.3
        },
        {
            group: 'sun',
            set: 'ademe',
            label: 'Photovoltaïque (S3Nuc)',
            data: [null, 13.6, null, null, 178.2],
            tension: 0.3
        },
        {
            group: 'sun',
            set: 'ademe',
            label: 'Photovoltaïque (S4)',
            data: [null, 13.6, null, null, 180.2],
            tension: 0.3
        },
        {
            group: 'sun',
            set: 'nw',
            label: 'Photovoltaïque (2011)',
            data: [1, 21, 51, 76, 90],
            tension: 0.3
        },
        {
            group: 'sun',
            set: 'nw',
            label: 'Photovoltaïque (2017)',
            data: [1, 16, 59, 108, 147],
            tension: 0.3
        },
        {
            group: 'sun',
            set: 'nw',
            label: 'Photovoltaïque (2022)',
            data: [null, 13, 59, 119, 168],
            tension: 0.3
        },
        {
            group: 'biogas',
            set: 'nw',
            label: 'Biogaz (2011)',
            data: [4, 27, 73, 123, 157],
            tension: 0.3
        },
        {
            group: 'biogas',
            set: 'nw',
            label: 'Biogaz (2017)',
            data: [4, 10, 54, 115, 134],
            tension: 0.3
        },
        {
            group: 'biogas',
            set: 'nw',
            label: 'Biogaz (2022)',
            data: [null, 13, 45, 108, 139],
            tension: 0.3
        },
        {
            group: 'biomass',
            set: 'nw',
            label: 'Biomasse solide (2011)',
            data: [136, 165, 212, 259, 263],
            tension: 0.3
        },
        {
            group: 'biomass',
            set: 'nw',
            label: 'Biomasse solide (2017)',
            data: [127, 160, 203, 240, 247],
            tension: 0.3
        },
        {
            group: 'biomass',
            set: 'nw',
            label: 'Biomasse solide (2022)',
            data: [null, 131, 148, 183, 196],
            tension: 0.3
        },
        {
            group: 'oil',
            set: 'nw',
            label: 'Pétrole (2011)',
            data: [859, 698, 337, 110, 48],
            tension: 0.3
        },
        {
            group: 'oil',
            set: 'nw',
            label: 'Pétrole (2017)',
            data: [831, 688, 361, 76, 4],
            tension: 0.3
        },
        {
            group: 'oil',
            set: 'nw',
            label: 'Pétrole (2022)',
            data: [null, 844, 522, 188, 33],
            tension: 0.3
        },
        {
            group: 'nuclear',
            set: 'rte',
            label: 'Nucléaire (M0)',
            data: [null, 1028.4, null, null, 0],
            tension: 0.3
        },
        {
            group: 'nuclear',
            set: 'rte',
            label: 'Nucléaire (M1)',
            data: [null, 1028.4, null, null, 91],
            tension: 0.3
        },
        {
            group: 'nuclear',
            set: 'rte',
            label: 'Nucléaire (M23)',
            data: [null, 1028.4, null, null, 91],
            tension: 0.3
        },
        {
            group: 'nuclear',
            set: 'rte',
            label: 'Nucléaire (N1)',
            data: [null, 1028.4, null, null, 182],
            tension: 0.3
        },
        {
            group: 'nuclear',
            set: 'rte',
            label: 'Nucléaire (N2)',
            data: [null, 1028.4, null, null, 252],
            tension: 0.3
        },
        {
            group: 'nuclear',
            set: 'rte',
            label: 'Nucléaire (M03)',
            data: [null, 1028.4, null, null, 338],
            tension: 0.3
        },
        {
            group: 'nuclear',
            set: 'ademe',
            label: 'Nucléaire (S1)',
            data: [null, 1028.4, null, null, 10.1],
            tension: 0.3
        },
        {
            group: 'nuclear',
            set: 'ademe',
            label: 'Nucléaire (S2)',
            data: [null, 1028.4, null, null, 74.7],
            tension: 0.3
        },
        {
            group: 'nuclear',
            set: 'ademe',
            label: 'Nucléaire (S3ENR)',
            data: [null, 1028.4, null, null, 70.2],
            tension: 0.3
        },
        {
            group: 'nuclear',
            set: 'ademe',
            label: 'Nucléaire (S3Nuc)',
            data: [null, 1028.4, null, null, 132.2],
            tension: 0.3
        },
        {
            group: 'nuclear',
            set: 'ademe',
            label: 'Nucléaire (S4)',
            data: [null, 1028.4, null, null, 187.7],
            tension: 0.3
        },
        {
            group: 'nuclear',
            set: 'nw',
            label: 'Nucléaire (2011)',
            data: [1240, 770, 261, 0, 0],
            tension: 0.3
        },
        {
            group: 'nuclear',
            set: 'nw',
            label: 'Nucléaire (2017)',
            data: [1226, 999, 227, 0, 0],
            tension: 0.3
        },
        {
            group: 'nuclear',
            set: 'nw',
            label: 'Nucléaire (2022)',
            data: [null, 1004, 701, 242, 0],
            tension: 0.3
        },
        {
            group: 'hydro',
            set: 'rte',
            label: 'Hydraulique (M0)',
            data: [null, 61.7, null, null, 63],
            tension: 0.3
        },
        {
            group: 'hydro',
            set: 'rte',
            label: 'Hydraulique (M1)',
            data: [null, 61.7, null, null, 63],
            tension: 0.3
        },
        {
            group: 'hydro',
            set: 'rte',
            label: 'Hydraulique (M23)',
            data: [null, 61.7, null, null, 62],
            tension: 0.3
        },
        {
            group: 'hydro',
            set: 'rte',
            label: 'Hydraulique (N1)',
            data: [null, 61.7, null, null, 63],
            tension: 0.3
        },
        {
            group: 'hydro',
            set: 'rte',
            label: 'Hydraulique (N2)',
            data: [null, 61.7, null, null, 63],
            tension: 0.3
        },
        {
            group: 'hydro',
            set: 'rte',
            label: 'Hydraulique (N03)',
            data: [null, 61.7, null, null, 63],
            tension: 0.3
        },
        {
            group: 'hydro',
            set: 'ademe',
            label: 'Hydraulique (S1)',
            data: [null, 61.7, null, null, 63.5],
            tension: 0.3
        },
        {
            group: 'hydro',
            set: 'ademe',
            label: 'Hydraulique (S2)',
            data: [null, 61.7, null, null, 63.5],
            tension: 0.3
        },
        {
            group: 'hydro',
            set: 'ademe',
            label: 'Hydraulique (S3ENR)',
            data: [null, 61.7, null, null, 63.5],
            tension: 0.3
        },
        {
            group: 'hydro',
            set: 'ademe',
            label: 'Hydraulique (S3Nuc)',
            data: [null, 61.7, null, null, 63.5],
            tension: 0.3
        },
        {
            group: 'hydro',
            set: 'ademe',
            label: 'Hydraulique (S4)',
            data: [null, 61.7, null, null, 63.5],
            tension: 0.3
        },
        {
            group: 'hydro',
            set: 'nw',
            label: 'Hydraulique (2011)',
            data: [61, 65, 68, 72, 77],
            tension: 0.3
        },
        {
            group: 'hydro',
            set: 'nw',
            label: 'Hydraulique (2017)',
            data: [62, 58, 57, 55, 54],
            tension: 0.3
        },
        {
            group: 'hydro',
            set: 'nw',
            label: 'Hydraulique (2022)',
            data: [null, 58, 57, 55, 54],
            tension: 0.3
        },
        {
            group: 'gas',
            set: 'nw',
            label: 'Gaz fossile (2011)',
            data: [501, 543, 432, 197, 42],
            tension: 0.3
        },
        {
            group: 'gas',
            set: 'nw',
            label: 'Gaz fossile (2017)',
            data: [515, 386, 354, 168, 1],
            tension: 0.3
        },
        {
            group: 'gas',
            set: 'nw',
            label: 'Gaz fossile (2022)',
            data: [null, 526, 311, 120, 12],
            tension: 0.3
        }
    ]
};