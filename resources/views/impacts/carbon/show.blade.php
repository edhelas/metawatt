@extends('layouts.app')

@section('title', 'Impact')
@section('subtitle', 'Émissions carbones')

@section('content')

<p>Émissions totales en tonnes de CO2 pour la production électrique pour chaque scénario au fil du temps.</p>

@include('parts.graph')

@endsection