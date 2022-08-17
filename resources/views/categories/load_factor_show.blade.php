@extends('layouts.app')

@section('title', catName($category->key))
@section('subtitle', 'Facteur de charge')
@section('title-icon', catIcon($category->key))

@section('content')

<p>Évolution du facteur de charge en pourcent au fil des décennies.</p>

@include('parts.graph')

@endsection