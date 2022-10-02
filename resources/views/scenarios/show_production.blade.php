@extends('layouts.app')

@section('title', $scenario->name)
@section('subtitle', typeName($type))

@section('content')

<p>Production électrique en TWh du scénario pour les différentes sources d'électricité au cours du temps.<br />
    Voir la
    <a href="{{ route('scenarios.show.capacity', $scenario->id) }}" class="btn btn-secondary btn-sm">
        Capacité
    </a>
    déployée pour arriver à cette production.
</p>

@include('parts.graph')

<div class="container mt-4">
    <div class="row">
        <div class="col-12 col-md-6">
            @if ($previousScenario)
            @include('parts.scenario_production_card', ['scenario' => $previousScenario])
            @endif
        </div>
        <div class="col-12 col-md-6">
            @if ($nextScenario)
            @include('parts.scenario_production_card', ['scenario' => $nextScenario])
            @endif
        </div>
    </div>
</div>

@endsection