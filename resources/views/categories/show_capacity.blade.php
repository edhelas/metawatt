@extends('layouts.app')

@section('title', catName($category->key))
@section('title-icon', catIcon($category->key))

@section('content')

<p>Capacity en GW déployée pour les différent scénarios au fil du temps.</p>

@include('parts.graph')

@endsection