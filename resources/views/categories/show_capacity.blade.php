@extends('layouts.app')

@section('title', catName($category->key))
@section('subtitle', 'Capacité')
@section('title-icon', catIcon($category->key))
@section('title-icon-color', catColor($category->key))

@section('content')

@if ($category->key == 'step')
    <p>Parc déployée en turbinage pour les différents scénarios au fil du temps.</p>
@else
    <p>Parc déployée en GW pour les différents scénarios au fil du temps.</p>
@endif

@include('parts.graph')

@endsection