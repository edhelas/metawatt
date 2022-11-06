@extends('layouts.app')

@section('title', catName($category->key))
@section('subtitle', 'Capacité')
@section('title-icon', catIcon($category->key))
@section('title-icon-color', catColor($category->key))

@section('content')

<p>Capacité en GW déployée pour les différents scénarios au fil du temps.</p>

@include('parts.graph')

@endsection