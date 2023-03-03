@extends('layouts.app')

@section('title', 'Impact')
@section('subtitle', 'Émissions carbones')

@section('content')

<p>Émissions totales en tonnes de CO2 pour la production électrique pour chaque scénario au fil du temps.</p>
<p>Sources en gCO2eq/kWh (données IPCC 2014 et <a href="https://www.edf.fr/groupe-edf/produire-une-energie-respectueuse-du-climat/lenergie-nucleaire/notre-vision/analyse-cycle-de-vie-du-kwh-nucleaire-dedf">EDF 2022</a> pour le nucléaire).</p>

@include('parts.gas_mix')

<ul class="nav nav-pills justify-content-center mb-3">
    <li class="nav-item">
        <a class="nav-link @if (!$perkWh)active @endif" href="{{ route('impacts.carbon.show') }}">Émission cumulées</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if ($perkWh)active @endif" href="{{ route('impacts.carbon.perkwh') }}">Émissions moyenne par kWh</a>
    </li>
</ul>

@include('parts.graph')


@endsection