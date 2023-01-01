@extends('layouts.app')

@section('title', $category->title)
@section('subtitle', 'Facteur de charge')
@section('title-icon', catIcon($category->key))
@section('title-icon-color', $category->color)

@section('content')

@include('parts.category_types_card', ['category' => $category])

<p>Évolution du facteur de charge en pourcent au fil des décennies.</p>

@include('parts.graph')

@endsection