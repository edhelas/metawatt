@extends('layouts.app')

@section('content')

<h1><i class="fa-graph"></i> Impact <small class="text-muted">{{ $resources[$resource] }}</small></h1>

<p>Mobilisation de la resource en tonnes pour chaque scénario envisagé en {{ $year }}</p>

@include('parts.graph')

@endsection