@extends('layouts.app')

@section('content')

<h1><i class="fa-graph"></i> {{ $scenario->name }} <small class="text-muted">{{ typeName($type) }}</small></h1>

@include('parts.graph')

@endsection