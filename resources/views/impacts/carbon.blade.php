@extends('layouts.app')

@section('title', 'Impact')
@section('subtitle', 'Carbone')

@section('content')

<p>Émissions totales en tonnes de CO2 à l'issue de la transition en {{ $year}}.<br />
    Sources en gCO2eq/kWh (données IPCC 2014).</p>

@include('parts.graph')

@endsection