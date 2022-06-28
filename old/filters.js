function filter (group) {
    let filteredData =  {
        labels: labels,
        datasets: []
    };

    data.datasets.forEach(e => {
        if (e.group == group) {
            filteredData.datasets.push(e);
        }
    });

    generate(filteredData);
}