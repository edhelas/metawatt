@extends('layouts.app')

@section('title', 'Impact')
@section('subtitle', 'Carbone')

@section('content')

<p>Émissions totales en tonnes de CO2 à l'issue de la transition en {{ $year}} pour la production électrique.<br />
    Sources en gCO2eq/kWh (données IPCC 2014 et EDF pour le nucléaire).</p>
<p>Production électrique totale à l'issue de la transition en {{ $year }}</p>

@include('parts.graph')

@endsection