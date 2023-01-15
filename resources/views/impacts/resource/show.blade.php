@extends('layouts.app')

@section('title', 'Impact')
@section('subtitle', $resources[$resource])

@section('content')

@if (in_array($resource, array_keys(resourcesSpace())))
    <p>Surface occupée au fil du temps</p>
@elseif(in_array($resource, array_keys(resourcesFuel())))
    <p>Consommation de la resource en tonnes au fil du temps</p>
@else
    <p>Mobilisation de la resource en tonnes au fil du temps</p>
@endif

@include('parts.graph')

<br />

@include('parts.sources_resource_impact')

@endsection