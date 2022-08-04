@extends('layouts.app')

@section('content')

<h1><i class="fa-graph"></i> Impact <small class="text-muted">{{ $resources[$resource] }}</small></h1>

@if ($resource == 'space')
    <p>Surface artificialisée au fil du temps</p>
@else
    <p>Mobilisation de la resource en tonnes au fil du temps</p>
@endif

@include('parts.graph')

@endsection