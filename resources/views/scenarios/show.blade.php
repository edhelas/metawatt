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
                    <div class="col-6 mt-2 mb-4 nopadding">
                        <h4 class="card-title">
                            {{ $totalCarbon }} gCO2eq/kWh
                            <small class="text-muted">émis</small>
                        </h4>
                        <p class="mt-1">
                            {{ compareCarbon2021($totalCarbon) }}x <span class="text-muted">la moyenne de 2021(<a href="https://ourworldindata.org/grapher/carbon-intensity-electricity?tab=chart&country=~FRA">58gCO2eq/kWh</a>)</span>
                        </p>
                        <a href="{{ route('impacts.carbon.show.final') }}" class="btn btn-secondary btn-sm">
                            <i class="fa-solid fa-chart-bar"></i> Comparateur carbone
                        </a>
                    </div>
                    <div class="col-6 mt-2 nopadding">
                        <h4 class="card-title">
                            {{ $totalSpace }} ha
                            <small class="text-muted"> artificialisés</small>
                        </h4>
                        <p class="mt-1">
                            {{ compareParis($totalSpace) }}x <span class="text-muted">la superficie de
                            <a href="https://fr.wikipedia.org/wiki/Paris" title="105,40 km2">Paris</a></span>
                        </p>
                        <a href="{{ route('impacts.resources.show', 'space') }}" class="btn btn-secondary btn-sm">
                            <i class="fa-solid fa-chart-bar"></i> Comparateur
                        </a>
                    </div>
                    <div class="col-6 nopadding">
                        <h4 class="card-title">
                            {{ $totalCapacity }} GW
                            <small class="text-muted">de capacité <i class="fa-solid fa-bolt"></i> déployé</small>
                        </h4>
                        <p>
                            {{ $totalLowCarbon }} GW
                            <span class="text-muted">bas carbone, soit {{ percentage($totalLowCarbon, $totalCapacity) }}%</span>
                            <br />
                            {{ $totalRenewable }} GW
                            <span class="text-muted">renouvelable, soit {{ percentage($totalRenewable, $totalCapacity) }}%</span>
                        </p>
                        <a href="{{ route('scenarios.show.capacity', $scenario->slug) }}"
                            class="btn btn-secondary btn-sm">
                            <i class="fa-solid fa-chart-line"></i> Capacité
                        </a>
                    </div>
                    <div class="col-6 nopadding">
                        <h4 class="card-title">
                            {{ $totalProduction }} TWh
                            <small class="text-muted">d'<i class="fa-solid fa-bolt"></i> produit</small>
                        </h4>

                        @if ($finalConsumption && $finalConsumption->production > 0)
                            <p class="mt-1">
                                sur {{ $finalConsumption->production }} GW <span class="text-muted">, soit {{ percentage($totalProduction, $finalConsumption->production) }}%</span>
                            </p>
                        @endif

                        <a href="{{ route('scenarios.show.energy', $scenario->slug) }}"
                            class="btn btn-secondary btn-sm">
                            <i class="fa-solid fa-chart-line"></i> Énergies
                        </a>
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