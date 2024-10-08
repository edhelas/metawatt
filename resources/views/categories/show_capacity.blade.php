@extends('layouts.app')

@section('title', $category->title)
@section('subtitle', 'Capacité')
@section('title-icon', catIcon($category->key))
@section('title-icon-color', $category->color)

@section('content')

@include('parts.category_types_card', ['category' => $category])

@if ($category->key == 'battery')
    <p>Parc déployé en puissance de conversion (lignes pleines) et en capacité utile (lignes pointillées) pour les différents scénarios au fil du temps.</p>
@elseif ($category->key == 'step')
    <p>Parc déployé en turbines (lignes pleines) et volume de stockage (lignes pointillées) pour les différents scénarios au fil du temps.</p>
@else
    <p>Parc déployé en GW pour les différents scénarios au fil du temps.</p>
@endif

@include('parts.graph')

@endsection