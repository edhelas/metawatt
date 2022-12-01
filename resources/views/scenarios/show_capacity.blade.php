@extends('layouts.app')

@section('title', $scenario->name)
@section('subtitle', typeName($type))

@section('content')

<p>Capacité déployée en GW pour les différentes sources d'électricité au cours du temps.<br />
    Voir l'
    <a href="{{ route('scenarios.show.energy', $scenario->slug) }}" class="btn btn-secondary btn-sm">
        Énergie
    </a>
    électrique générée et finale consommée à partir de cette capacité.
</p>

@include('parts.graph')

<div class="container mt-4">
    <div class="row">
        <div class="col-12 col-md-6">
            @if ($previousScenario)
            @include('parts.scenario_capacity_card', ['scenario' => $previousScenario])
            @endif
        </div>
        <div class="col-12 col-md-6">
            @if ($nextScenario)
            @include('parts.scenario_capacity_card', ['scenario' => $nextScenario])
            @endif
        </div>
    </div>
</div>


@endsection