@extends('layouts.app')

@section('title', 'Impact final')
@section('subtitle', $resources[$resource])

@section('content')

@if ($resource == 'space')
<p>Artificialisation au sol en hectares final pour chaque scénario envisagé en {{ $year }}</p>
@else
<p>Mobilisation de la resource finale en tonnes pour chaque scénario envisagé en {{ $year }}</p>
@endif

@include('parts.graph')

<p>Nous avons ici projeté la capacité de chaque source d'énergie au fil des années par scénario et estimé la quantité de
    resource nécessaire à son déploiement.</p>

<p>Ci dessous le ratio par source d'énergie appliqué aux scénarios en @if ($resource == 'space')ha @else T @endif/ MW déployé:</p>

<div class="container">
    @foreach (['nuc', 'hydro', 'wind', 'hydrowind', 'gas', 'sun', 'coal'] as $category)
    <div class="row">
        <div class="col-5 text-right">
            {{ catName($category) }}
        </div>
        <div class="col-3 text-right">
            {{ resourceIntensityRTE($category, $resource) }} @if ($resource == 'space')ha @else T @endif
        </div>
    </div>
    @endforeach
</div>

<p class="mt-3">
    <i class="fa-solid fa-link"></i>
    <a href="https://www.rte-france.com/analyses-tendances-et-prospectives/bilan-previsionnel-2050-futurs-energetiques" target="_blank">
        Source: RTE 2020 - Annexes: Chapitre 12-3 et 12-4
    </a>
</p>

@endsection