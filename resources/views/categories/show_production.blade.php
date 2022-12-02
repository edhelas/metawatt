@extends('layouts.app')

@section('title', catName($category->key))
@section('subtitle', 'Production')
@section('title-icon', catIcon($category->key))
@section('title-icon-color', catColor($category->key))

@section('content')

@include('parts.category_types_card', ['category' => $category])

<p>Production en TWh pour les différents scénarios au fil du temps.</p>

@include('parts.graph')

@endsection