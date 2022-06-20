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
      label: 'Charbon (2011)',
      backgroundColor: 'gray',
      borderColor: 'gray',
      borderDash: [3, 3],
      data: [151, 82, 50, 28, 13],
      tension: 0.3
    },
    {
      label: 'Charbon (2017)',
      backgroundColor: 'gray',
      borderColor: 'gray',
      borderDash: [10, 10],
      data: [124, 47, 19, 7, 3],
      tension: 0.3
    },
    {
      label: 'Charbon (2022)',
      backgroundColor: 'gray',
      borderColor: 'gray',
      data: [null, 75, 27, 4, 0],
      tension: 0.3
    },
    {
      label: 'Eolien (2011)',
      backgroundColor: 'teal',
      borderColor: 'teal',
      borderDash: [3, 3],
      data: [10, 41, 115, 179, 209],
      tension: 0.3
    },
    {
      label: 'Eolien (2017)',
      backgroundColor: 'teal',
      borderColor: 'teal',
      borderDash: [10, 10],
      data: [10, 34, 123, 219, 247],
      tension: 0.3
    },
    {
      label: 'Eolien (2022)',
      backgroundColor: 'teal',
      borderColor: 'teal',
      data: [null, 40, 114, 231, 305],
      tension: 0.3
    },
    {
      label: 'Photovoltaïque (2011)',
      backgroundColor: 'skyblue',
      borderColor: 'skyblue',
      borderDash: [3, 3],
      data: [1, 21, 51, 76, 90],
      tension: 0.3
    },
    {
      label: 'Photovoltaïque (2017)',
      backgroundColor: 'skyblue',
      borderColor: 'skyblue',
      borderDash: [10, 10],
      data: [1, 16, 59, 108, 147],
      tension: 0.3
    },
    {
      label: 'Photovoltaïque (2022)',
      backgroundColor: 'skyblue',
      borderColor: 'skyblue',
      data: [null, 13, 59, 119, 168],
      tension: 0.3
    },
    {
      label: 'Biogaz (2011)',
      backgroundColor: 'green',
      borderColor: 'green',
      borderDash: [3, 3],
      data: [4, 27, 73, 123, 157],
      tension: 0.3
    },
    {
      label: 'Biogaz (2017)',
      backgroundColor: 'green',
      borderColor: 'green',
      borderDash: [10, 10],
      data: [4, 10, 54, 115, 134],
      tension: 0.3
    },
    {
      label: 'Biogaz (2022)',
      backgroundColor: 'green',
      borderColor: 'green',
      data: [null, 13, 45, 108, 139],
      tension: 0.3
    },
    {
      label: 'Biomasse solide (2011)',
      backgroundColor: 'maroon',
      borderColor: 'maroon',
      borderDash: [3, 3],
      data: [136, 165, 212, 259, 263],
      tension: 0.3
    },
    {
      label: 'Biomasse solide (2017)',
      backgroundColor: 'maroon',
      borderColor: 'maroon',
      borderDash: [10, 10],
      data: [127, 160, 203, 240, 247],
      tension: 0.3
    },
    {
      label: 'Biomasse solide (2022)',
      backgroundColor: 'maroon',
      borderColor: 'maroon',
      data: [null, 131, 148, 183, 196],
      tension: 0.3
    },
    {
      label: 'Pétrole (2011)',
      backgroundColor: 'chocolate',
      borderColor: 'chocolate',
      borderDash: [3, 3],
      data: [859, 698, 337, 110, 48],
      tension: 0.3
    },
    {
      label: 'Pétrole (2017)',
      backgroundColor: 'chocolate',
      borderColor: 'chocolate',
      borderDash: [10, 10],
      data: [831, 688, 361, 76, 4],
      tension: 0.3
    },
    {
      label: 'Pétrole (2022)',
      backgroundColor: 'chocolate',
      borderColor: 'chocolate',
      data: [null, 844, 522, 188, 33],
      tension: 0.3
    },
    {
      label: 'Uranium (2011)',
      backgroundColor: 'purple',
      borderColor: 'purple',
      borderDash: [3, 3],
      data: [1240, 770, 261, 0, 0],
      tension: 0.3
    },
    {
      label: 'Uranium (2017)',
      backgroundColor: 'purple',
      borderColor: 'purple',
      borderDash: [10, 10],
      data: [1226, 999, 227, 0, 0],
      tension: 0.3
    },
    {
      label: 'Uranium (2022)',
      backgroundColor: 'purple',
      borderColor: 'purple',
      data: [null, 1004, 701, 242, 0],
      tension: 0.3
    },
    {
      label: 'Hydraulique (2011)',
      backgroundColor: 'blue',
      borderColor: 'blue',
      borderDash: [3, 3],
      data: [61, 65, 68, 72, 77],
      tension: 0.3
    },
    {
      label: 'Hydraulique (2017)',
      backgroundColor: 'blue',
      borderColor: 'blue',
      borderDash: [10, 10],
      data: [62, 58, 57, 55, 54],
      tension: 0.3
    },
    {
      label: 'Hydraulique (2022)',
      backgroundColor: 'blue',
      borderColor: 'blue',
      data: [null, 58, 57, 55, 54],
      tension: 0.3
    },
    {
      label: 'Gaz fossile (2011)',
      backgroundColor: 'gold',
      borderColor: 'gold',
      borderDash: [3, 3],
      data: [501, 543, 432, 197, 42],
      tension: 0.3
    },
    {
      label: 'Gaz fossile (2017)',
      backgroundColor: 'gold',
      borderColor: 'gold',
      borderDash: [10, 10],
      data: [515, 386, 354, 168, 1],
      tension: 0.3
    },
    {
      label: 'Gaz fossile (2022)',
      backgroundColor: 'gold',
      borderColor: 'gold',
      data: [null, 526, 311, 120, 12],
      tension: 0.3
    }
  ]
};

const config = {
  type: 'line',
  data: data,
  options: {/*
    scales: {
      x: {
        stacked: true,
      },
      y: {
        stacked: true
      }
    }*/
  }
};

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