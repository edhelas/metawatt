@extends('layouts.app')

@section('title', 'Impact')
@section('subtitle', 'Carbone')

@section('content')

<p>Émissions totales cumulées en tonnes de CO2 jusqu'en {{ $year}} pour la production électrique.</p>
<p>
    Le losange blanc ⬦ présente la production totale cumulée d'électricité jusqu'en en {{ $year }}<br />
    Sources en gCO2eq/kWh (données IPCC 2014 et <a href="https://www.edf.fr/groupe-edf/produire-une-energie-respectueuse-du-climat/lenergie-nucleaire/notre-vision/analyse-cycle-de-vie-du-kwh-nucleaire-dedf">EDF 2022</a> pour le nucléaire).
</p>

@include('parts.missing_fossils_ademe')

@include('parts.graph')


@endsection