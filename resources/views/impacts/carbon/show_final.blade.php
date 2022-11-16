@extends('layouts.app')

@section('title', 'Impact')
@section('subtitle', 'Carbone')

@section('content')

<p>Émissions totales cumulées en tonnes de CO2 jusqu'en {{ $year}} pour la production électrique.</p>
<p>
    Le losange blanc ⬦ présente la production totale cumulée d'électricité jusqu'en en {{ $year }}<br />
    Sources en gCO2eq/kWh (données disponible sur <a href="https://app.electricitymaps.com/zone/FR">ElectricityMaps pour la France</a>).
</p>

@include('parts.missing_fossils_ademe')

@include('parts.graph')


@endsection