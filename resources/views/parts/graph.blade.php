<div id="chart" style="height: 70vh; position: relative;"></div>

<script>
    const config = {!! $jsonConfig !!};

    chart = document.getElementById('chart');
    chart.innerHTML = '';

    canvas = document.createElement('canvas');
    canvas.id = 'myChart';
    chart.appendChild(canvas);

    new Chart(
        document.getElementById('myChart'),
        config
    );
</script>
