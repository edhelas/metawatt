@extends('layouts.app')

@section('content')

<h1><i class="fa-graph"></i> Impact <small class="text-muted">{{ $resources[$resource] }}</small></h1>

<p>Consommation en tonnes pour chaque scénario envisagé.</p>

@include('parts.graph')

@endsection