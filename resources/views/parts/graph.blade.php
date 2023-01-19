<div id="chart" @if (isset($style))style="{{ $style }}" @endif></div>

<script>
    const config = {!! $jsonConfig !!};

    chart = document.getElementById('chart');
    chart.innerHTML = '';

    canvas = document.createElement('canvas');
    canvas.id = 'myChart';
    chart.appendChild(canvas);

    @if (isset($withDataLabel) && $withDataLabel)
        config.plugins = [ChartDataLabels];
    @endif

    @if (isset($showLabel) && $showLabel)
        config.options.plugins.datalabels.formatter = function(value, context) {
            return value + ' ' + context.dataset.label;
        }
    @endif

    if (config.options == undefined) {
        config.options = {};
    }

    if (config.options.plugins == undefined) {
        config.options.plugins = {};
    }

    config.options.plugins.legend = {};
    config.options.plugins.legend.labels = {
        boxWidth: 15,
        boxHeight: 15,
        useBorderRadius: true,
        borderRadius: 3,
        padding: 10
    }

    config.options.plugins.tooltip = {
        callbacks: {
            footer: function(items) {
                if (items.length > 1) {
                    return 'Total: ' + (items.reduce((a, b) => a + b.parsed.y, 0)).toFixed(2)
                }
            }
        }
    };

    new Chart(
        document.getElementById('myChart'),
        config
    );
</script>

<br />

@if (!empty($sources))
    <p class="mt-3">
        Sources: <br />
        @foreach ($sources as $key => $value)
            {{ $key }}
            <i class="fa-solid fa-link"></i>
            <a href="{{ $value['url'] }}" target="_blank">
                {{ $value['title'] }}
            </a>
        @endforeach
    </p>
@endif