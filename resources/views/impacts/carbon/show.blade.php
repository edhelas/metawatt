@extends('layouts.app')

@section('title', 'Impact')
@section('subtitle', 'Émissions carbones')

@section('content')

<p>Émissions totales en tonnes de CO2 pour la production électrique pour chaque scénario au fil du temps.</p>
<p>Sources en gCO2eq/kWh (données IPCC 2014 et <a href="https://www.edf.fr/groupe-edf/produire-une-energie-respectueuse-du-climat/lenergie-nucleaire/notre-vision/analyse-cycle-de-vie-du-kwh-nucleaire-dedf">EDF 2022</a> pour le nucléaire).</p>

@include('parts.graph')


@endsection