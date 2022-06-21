function generate(data) {
    let adjustedData =  {
        labels: labels,
        datasets: []
    };

    data.datasets.forEach(e => {
        let adjustedDataItem = Object.assign({}, e);

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
                adjustedDataItem.borderDash = [3, 3];
                break;

            case 'rte':
                adjustedDataItem.label = 'RTE ' + adjustedDataItem.label;
                adjustedDataItem.pointStyle = 'star';
                adjustedDataItem.borderDash = [10, 10];
                break;

            case 'ademe':
                adjustedDataItem.label = 'ADEME ' + adjustedDataItem.label;
                adjustedDataItem.pointStyle = 'rectRounded';
                adjustedDataItem.borderDash = [20, 20];
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