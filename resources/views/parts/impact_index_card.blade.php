<div class="col">
    <div class="card mb-4">
        <img src="{{ resourceImage($key) }}" class="card-img-top">
        <div class="card-body">
            <h5 class="card-title">{{ $name }}</h5>
            <p class="card-text">
                @if ($evolution)
                    <i class="fa-solid fa-chart-line"></i>
                    <a href="{{ route('impacts.resources.show', $key) }}">Évolution dans le temps</a><br />
                @endif

                <i class="fa-solid fa-chart-column"></i>
                @if (in_array($key, array_keys(resourcesFuel())))
                    <a href="{{ route('impacts.consumption.show.final', $key) }}">Consommation totale en 2050</a>
                @else
                    <a href="{{ route('impacts.resources.show.final', $key) }}">Impact total en 2050</a>
                @endif
            </p>
        </div>
    </div>
</div>