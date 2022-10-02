@extends('layouts.app')

@section('title', $scenario->name)
@section('subtitle', typeName($type))

@section('content')

<p>Capacité déployée en GW pour les différentes sources d'électricité au cours du temps.<br />
    Voir la
    <a href="{{ route('scenarios.show.production', $scenario->id) }}" class="btn btn-secondary btn-sm">
        Production
    </a>
    électrique générée à partir de cette capacité.
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