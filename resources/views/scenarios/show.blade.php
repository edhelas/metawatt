@extends('layouts.app')

@section('content')

<h1><i class="fa-graph"></i> {{ $scenario->name }}</h1>

<h2>{{ typeName($type) }}</h2>

@include('parts.graph')

@endsection