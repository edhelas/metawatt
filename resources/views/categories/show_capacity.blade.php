@extends('layouts.app')

@section('title', catName($category->key))
@section('subtitle', 'Capacité')
@section('title-icon', catIcon($category->key))

@section('content')

<p>Capacité en GW déployée pour les différent scénarios au fil du temps.</p>

@include('parts.graph')

@endsection