<div id="chart2" style="height: 70vh; position: relative;"></div>

<script>
    const config2 = {!! $jsonConfig2 !!};

    chart2 = document.getElementById('chart2');
    chart2.innerHTML = '';

    canvas2 = document.createElement('canvas');
    canvas2.id = 'myChart2';
    chart2.appendChild(canvas2);

    new Chart(
        document.getElementById('myChart2'),
        config2
    );
</script>
