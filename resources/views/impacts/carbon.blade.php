@extends('layouts.app')

@section('content')

<h1><i class="fa-graph"></i> Impact <small class="text-muted">Carbone</small></h1>

<p>Émissions totales en tonnes de CO2 à l'issue de la transition en {{ $year}}.<br />
    Sources en gCO2eq/kWh (données IPCC 2014).</p>

@include('parts.graph')

@endsection