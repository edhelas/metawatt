@extends('layouts.app')

@section('title', 'Impact final')
@section('subtitle', $resources[$resource])

@section('content')

@if ($resource == 'space')
<p>Artificialisation au sol en hectares final pour chaque scénario envisagé en {{ $year }}</p>
@else
<p>Mobilisation de la resource finale en tonnes pour chaque scénario envisagé en {{ $year }}</p>
@endif
<p>Le losange blanc ⬦ présente la production totale d'électricité à l'issue de la transition en {{ $year }}</p>

@include('parts.graph')

<p>Nous avons ici projeté la capacité de chaque source d'énergie au fil des années par scénario et estimé la quantité de
    resource nécessaire à son déploiement.</p>

<p>Ci dessous le ratio par source d'énergie appliqué aux scénarios en @if ($resource == 'space')ha @else T @endif/ MW déployé au fil des décennies:</p>

<div class="container">
    <div class="row">
        <div class="col-4 text-right">
            <b>Source</b>
        </div>
        <div class="col-2 text-right">
            <b>2020</b>
        </div>
        <div class="col-2 text-right">
            <b>2030</b>
        </div>
        <div class="col-2 text-right">
            <b>2040</b>
        </div>
        <div class="col-2 text-right">
            <b>2050</b>
        </div>
    </div>

    @foreach (['nuc', 'hydro', 'wind', 'hydrowind', 'gas', 'sun', 'coal'] as $category)
    <div class="row">
        <div class="col-4 text-right">
            {{ catName($category) }}
        </div>
        <div class="col-2 text-right">
            {{ resourceIntensityRTE($category, $resource, 2020) }}
        </div>
        <div class="col-2 text-right">
            {{ resourceIntensityRTE($category, $resource, 2030) }}
        </div>
        <div class="col-2 text-right">
            {{ resourceIntensityRTE($category, $resource, 2040) }}
        </div>
        <div class="col-2 text-right">
            {{ resourceIntensityRTE($category, $resource, 2050) }}
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