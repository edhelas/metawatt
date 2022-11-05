@extends('layouts.app')

@section('title', $scenario->name)
@section('subtitle', $scenario->introduction)

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 col-lg-8 mb-4 nopadding">
            @if (!empty(groupLogo($scenario->group)))
            <img class="group_logo" src="{{ groupLogo($scenario->group) }}" />
            @endif

            @if (!empty($scenario->description))
            {!! markdown($scenario->description) !!}
            @endif

            <div class="container">
                <div class="row">
                    <div class="col-12 nopadding">
                        <h5>À l'issue de la transition, l'année 2050:</h5>
                    </div>
                    <div class="col-6 nopadding">
                        <h4 class="card-title">
                            {{ $totalCapacity }}
                            <small class="text-muted">GW déployé</small>
                        </h4>
                        <a href="{{ route('scenarios.show.capacity', $scenario->slug) }}"
                            class="btn btn-secondary btn-sm">
                            <i class="fa-solid fa-chart-line"></i> Capacité
                        </a>
                    </div>
                    <div class="col-6 nopadding">
                        <h4 class="card-title">
                            {{ $totalProduction }}
                            <small class="text-muted">TWh produit</small>
                        </h4>
                        <a href="{{ route('scenarios.show.production', $scenario->slug) }}"
                            class="btn btn-secondary btn-sm">
                            <i class="fa-solid fa-chart-line"></i> Production
                        </a>
                    </div>
                    <div class="col-6 mt-2 nopadding">
                        <h4 class="card-title">
                            {{ $totalCarbon }}
                            <small class="text-muted">gCO2eq/kWh émis</small>
                        </h4>
                        <a href="{{ route('impacts.carbon.show.final') }}" class="btn btn-secondary btn-sm">
                            <i class="fa-solid fa-chart-bar"></i> Comparateur
                        </a>
                        <p class="mt-1">
                            {{ compareCarbon2021($totalCarbon) }}x la moyenne de 2021 (<a href="https://ourworldindata.org/grapher/carbon-intensity-electricity?tab=chart&country=~FRA">58gCO2eq/kWh</a>)
                        </p>
                    </div>
                    <div class="col-6 mt-2 nopadding">
                        <h4 class="card-title">
                            {{ $totalSpace }}
                            <small class="text-muted">ha artificialisés</small>
                        </h4>
                        <a href="{{ route('impacts.resources.show', 'space') }}" class="btn btn-secondary btn-sm">
                            <i class="fa-solid fa-chart-bar"></i> Comparateur
                        </a>
                        <p class="mt-1">
                            {{ compareParis($totalSpace) }}x la superficie de
                            <a href="https://fr.wikipedia.org/wiki/Paris" title="105,40 km2">Paris</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4 mb-4 text-center nopadding">
            <h5>L'année 2050</h5>
            <p>Capacité déployée & production correspondante</p>
            @include('parts.graph', ['style' => 'height: 60vh;'])
        </div>

        <div class="col-12">
            @include('parts.group_sources', ['group' => $scenario->group])
        </div>

        <div class="col-12 col-md-6">
            @if ($previousScenario)
            @include('parts.scenario_card', ['scenario' => $previousScenario])
            @endif
        </div>
        <div class="col-12 col-md-6">
            @if ($nextScenario)
            @include('parts.scenario_card', ['scenario' => $nextScenario])
            @endif
        </div>
    </div>
</div>


@endsection