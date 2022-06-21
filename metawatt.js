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
            borderDash: [3, 3],
            data: [151, 82, 50, 28, 13],
            tension: 0.3
        },
        {
            group: 'coal',
            set: 'nw',
            label: 'Charbon (2017)',
            borderDash: [10, 10],
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
            set: 'ademe',
            label: 'Eolien (S1)',
            borderDash: [3, 3],
            data: [null, 40.7, null, null, 210.3],
            tension: 0.3
        },
        {
            group: 'wind',
            set: 'ademe',
            label: 'Eolien (S2)',
            borderDash: [3, 3],
            data: [null, 40.7, null, null, 255.7],
            tension: 0.3
        },
        {
            group: 'wind',
            set: 'ademe',
            label: 'Eolien (S3ENR)',
            borderDash: [3, 3],
            data: [null, 40.7, null, null, 327.6],
            tension: 0.3
        },
        {
            group: 'wind',
            set: 'ademe',
            label: 'Eolien (S3Nuc)',
            borderDash: [3, 3],
            data: [null, 40.7, null, null, 240.3],
            tension: 0.3
        },
        {
            group: 'wind',
            set: 'ademe',
            label: 'Eolien (S4)',
            borderDash: [3, 3],
            data: [null, 40.7, null, null, 341.3],
            tension: 0.3
        },
        {
            group: 'wind',
            set: 'nw',
            label: 'Eolien (2011)',
            borderDash: [3, 3],
            data: [10, 41, 115, 179, 209],
            tension: 0.3
        },
        {
            group: 'wind',
            set: 'nw',
            label: 'Eolien (2017)',
            borderDash: [10, 10],
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
            set: 'ademe',
            label: 'Photovoltaïque (S1)',
            borderDash: [3, 3],
            data: [null, 13.6, null, null, 118.2],
            tension: 0.3
        },
        {
            group: 'sun',
            set: 'ademe',
            label: 'Photovoltaïque (S2)',
            borderDash: [3, 3],
            data: [null, 13.6, null, null, 123.5],
            tension: 0.3
        },
        {
            group: 'sun',
            set: 'ademe',
            label: 'Photovoltaïque (S3ENR)',
            borderDash: [3, 3],
            data: [null, 13.6, null, null, 176.3],
            tension: 0.3
        },
        {
            group: 'sun',
            set: 'ademe',
            label: 'Photovoltaïque (S3Nuc)',
            borderDash: [3, 3],
            data: [null, 13.6, null, null, 178.2],
            tension: 0.3
        },
        {
            group: 'sun',
            set: 'ademe',
            label: 'Photovoltaïque (S4)',
            borderDash: [3, 3],
            data: [null, 13.6, null, null, 180.2],
            tension: 0.3
        },
        {
            group: 'sun',
            set: 'nw',
            label: 'Photovoltaïque (2011)',
            borderDash: [3, 3],
            data: [1, 21, 51, 76, 90],
            tension: 0.3
        },
        {
            group: 'sun',
            set: 'nw',
            label: 'Photovoltaïque (2017)',
            borderDash: [10, 10],
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
            borderDash: [3, 3],
            data: [4, 27, 73, 123, 157],
            tension: 0.3
        },
        {
            group: 'biogas',
            set: 'nw',
            label: 'Biogaz (2017)',
            borderDash: [10, 10],
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
            borderDash: [3, 3],
            data: [136, 165, 212, 259, 263],
            tension: 0.3
        },
        {
            group: 'biomass',
            set: 'nw',
            label: 'Biomasse solide (2017)',
            borderDash: [10, 10],
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
            borderDash: [3, 3],
            data: [859, 698, 337, 110, 48],
            tension: 0.3
        },
        {
            group: 'oil',
            set: 'nw',
            label: 'Pétrole (2017)',
            borderDash: [10, 10],
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
            set: 'ademe',
            label: 'Nucléaire (S1)',
            borderDash: [3, 3],
            data: [null, 1028.4, null, null, 10.1],
            tension: 0.3
        },
        {
            group: 'nuclear',
            set: 'ademe',
            label: 'Nucléaire (S2)',
            borderDash: [3, 3],
            data: [null, 1028.4, null, null, 74.7],
            tension: 0.3
        },
        {
            group: 'nuclear',
            set: 'ademe',
            label: 'Nucléaire (S3ENR)',
            borderDash: [3, 3],
            data: [null, 1028.4, null, null, 70.2],
            tension: 0.3
        },
        {
            group: 'nuclear',
            set: 'ademe',
            label: 'Nucléaire (S3Nuc)',
            borderDash: [3, 3],
            data: [null, 1028.4, null, null, 132.2],
            tension: 0.3
        },
        {
            group: 'nuclear',
            set: 'ademe',
            label: 'Nucléaire (S4)',
            borderDash: [3, 3],
            data: [null, 1028.4, null, null, 187.7],
            tension: 0.3
        },
        {
            group: 'nuclear',
            set: 'nw',
            label: 'Nucléaire (2011)',
            borderDash: [3, 3],
            data: [1240, 770, 261, 0, 0],
            tension: 0.3
        },
        {
            group: 'nuclear',
            set: 'nw',
            label: 'Nucléaire (2017)',
            borderDash: [10, 10],
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
            set: 'ademe',
            label: 'Hydraulique (S1)',
            borderDash: [5, 3],
            data: [null, 61.7, null, null, 63.5],
            tension: 0.3
        },
        {
            group: 'hydro',
            set: 'ademe',
            label: 'Hydraulique (S2)',
            borderDash: [5, 3],
            data: [null, 61.7, null, null, 63.5],
            tension: 0.3
        },
        {
            group: 'hydro',
            set: 'ademe',
            label: 'Hydraulique (S3ENR)',
            borderDash: [5, 3],
            data: [null, 61.7, null, null, 63.5],
            tension: 0.3
        },
        {
            group: 'hydro',
            set: 'ademe',
            label: 'Hydraulique (S3Nuc)',
            borderDash: [5, 3],
            data: [null, 61.7, null, null, 63.5],
            tension: 0.3
        },
        {
            group: 'hydro',
            set: 'ademe',
            label: 'Hydraulique (S4)',
            borderDash: [5, 3],
            data: [null, 61.7, null, null, 63.5],
            tension: 0.3
        },
        {
            group: 'hydro',
            set: 'nw',
            label: 'Hydraulique (2011)',
            borderDash: [3, 3],
            data: [61, 65, 68, 72, 77],
            tension: 0.3
        },
        {
            group: 'hydro',
            set: 'nw',
            label: 'Hydraulique (2017)',
            borderDash: [10, 10],
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
            borderDash: [3, 3],
            data: [501, 543, 432, 197, 42],
            tension: 0.3
        },
        {
            group: 'gas',
            set: 'nw',
            label: 'Gaz fossile (2017)',
            borderDash: [10, 10],
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

function generate(data) {
    let adjustedData =  {
        labels: labels,
        datasets: []
    };

    data.datasets.forEach(e => {
        let adjustedDataItem = e;

        adjustedDataItem.pointRadius = 7;

        switch (adjustedDataItem.group) {
            case 'gas':
                adjustedDataItem.backgroundColor = adjustedDataItem.borderColor = 'gold';
                break;
            case 'hydro':
                adjustedDataItem.backgroundColor = adjustedDataItem.borderColor = 'blue';
                break;
            case 'nuclear':
                adjustedDataItem.backgroundColor = adjustedDataItem.borderColor = 'purple';
                break;
            case 'oil':
                adjustedDataItem.backgroundColor = adjustedDataItem.borderColor = 'chocolate';
                break;
            case 'biomass':
                adjustedDataItem.backgroundColor = adjustedDataItem.borderColor = 'maroon';
                break;
            case 'biogas':
                adjustedDataItem.backgroundColor = adjustedDataItem.borderColor = 'green';
                break;
            case 'sun':
                adjustedDataItem.backgroundColor = adjustedDataItem.borderColor = 'skyblue';
                break;
            case 'wind':
                adjustedDataItem.backgroundColor = adjustedDataItem.borderColor = 'teal';
                break;
            case 'coal':
                adjustedDataItem.backgroundColor = adjustedDataItem.borderColor = 'gray';
                break;

            default:
                break;
        }

        switch (adjustedDataItem.set) {
            case 'nw':
                adjustedDataItem.label = 'nW ' + adjustedDataItem.label;
                adjustedDataItem.pointStyle = 'triangle';
                break;

            case 'ademe':
                adjustedDataItem.label = 'ADEME ' + adjustedDataItem.label;
                adjustedDataItem.pointStyle = 'rectRounded';
                break;
        }
        adjustedData.datasets.push(adjustedDataItem);
    });

    chart = document.getElementById('chart');
    chart.innerHTML = '';

    canvas = document.createElement('canvas');
    canvas.id = 'myChart';
    chart.appendChild(canvas);

    const config = {
        type: 'line',
        data: adjustedData,
        options: {
            spanGaps: true,
            scales: {
                y: {
                    title: {
                        display: true,
                        text: 'TWh',
                    }
                }
            },
            /*plugins: {
                tooltip: {
                    mode: 'index',
                    intersect: false
                }
            },
            hover: {
                mode: 'nearest',
                intersect: false
            }*/
        }
    };

    new Chart(
        document.getElementById('myChart'),
        config
    );
}

/*
Charbon
Pétrole
Gaz fossile
Uranium
Hydraulique
Eolien 10 34 123 219 247
Energies marines 1 1 13 13 14
Solaire photovoltaïque 1 16 59 108 147
Solaire thermique 1 2 7 14 19
Chaleur environnement 11 24 57 76 87
Géothermie 2 4 8 9 10
Biomasse solide 127 160 203 240 247
Biomasse liquide 31 30 26 30 37
Déchets 14 12 10 7 6
Biogaz 4 10 54 115 134*/