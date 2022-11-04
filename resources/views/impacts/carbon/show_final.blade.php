@extends('layouts.app')

@section('title', 'Impact')
@section('subtitle', 'Carbone')

@section('content')

<p>Émissions totales en tonnes de CO2 à l'issue de la transition en {{ $year}} pour la production électrique.</p>
<p>Le losange blanc ⬦ présente la production totale d'électricité à l'issue de la transition en {{ $year }}</p>

@include('parts.graph')

<p>Sources en gCO2eq/kWh (données IPCC 2014 et EDF pour le nucléaire).</p>

@endsection