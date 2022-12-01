@extends('layouts.app')

@section('title', 'Impact')
@section('subtitle', $resources[$resource])

@section('content')

@if ($resource == 'space')
    <p>Surface artificialisée au fil du temps</p>
@else
    <p>Mobilisation de la resource en tonnes au fil du temps</p>
@endif

@include('parts.graph')

<br />

@include('parts.sources_resource_impact')

@endsection