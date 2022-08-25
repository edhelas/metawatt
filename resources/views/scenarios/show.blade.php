@extends('layouts.app')

@section('title', $scenario->name)
@section('subtitle', $scenario->introduction)

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 col-lg-4 mb-4 nopadding">
            @if (!empty(groupLogo($scenario->group)))
            <img class="group_logo" src="{{ groupLogo($scenario->group) }}" />
            @endif

            @if (!empty($scenario->description))
            {!! markdown($scenario->description) !!}
            @endif

            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <h3>L'année 2050</h3>
                    </div>
                    <div class="col-6">
                        <h4 class="card-title">
                            {{ $totalCapacity }}
                            <small class="text-muted">GW déployé</small>
                        </h4>
                        <a href="{{ route('scenarios.show.capacity', $scenario->id) }}"
                            class="btn btn-secondary btn-sm">
                            <i class="fa-solid fa-chart-line"></i> Capacité
                        </a>
                    </div>
                    <div class="col-6">
                        <h4 class="card-title">
                            {{ $totalProduction }}
                            <small class="text-muted">TWh produit</small>
                        </h4>
                        <a href="{{ route('scenarios.show.production', $scenario->id) }}"
                            class="btn btn-secondary btn-sm">
                            <i class="fa-solid fa-chart-line"></i> Production
                        </a>
                    </div>
                    <div class="col-12 mt-2">
                        <h3 class="card-title">
                            {{ $totalCarbon }}
                            <small class="text-muted">TCO2eq/TWh émis</small>
                        </h3>
                        <a href="{{ route('impacts.carbon.show') }}" class="btn btn-secondary btn-sm">
                            <i class="fa-solid fa-chart-bar"></i> Impact carbone complet
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4 mb-4 text-center nopadding">
            <p>Capacité en 2050 <span class="text-muted">GW</span></p>
            @include('parts.graph')
        </div>
        <div class="col-12 col-md-6 col-lg-4 mb-4 text-center nopadding">
            <p>Production en 2050 <span class="text-muted">TWh</span></p>
            @include('parts.graph2')
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