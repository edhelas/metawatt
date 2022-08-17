@extends('layouts.app')

@section('title', 'Impact final')
@section('subtitle', $resources[$resource])

@section('content')

@if ($resource == 'space')
    <p>Artificialisation au sol en hectares final pour chaque scénario envisagé en {{ $year }}</p>
@else
    <p>Mobilisation de la resource finale en tonnes pour chaque scénario envisagé en {{ $year }}</p>
@endif

@include('parts.graph')

@endsection