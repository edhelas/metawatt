@extends('layouts.app')

@section('content')

<h1><i class="fa-graph"></i> Impact final <small class="text-muted">{{ $resources[$resource] }}</small></h1>

@if ($resource == 'space')
    <p>Artificialisation au sol en hectares final pour chaque scénario envisagé en {{ $year }}</p>
@else
    <p>Mobilisation de la resource finale en tonnes pour chaque scénario envisagé en {{ $year }}</p>
@endif

@include('parts.graph')

@endsection