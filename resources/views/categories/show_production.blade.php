@extends('layouts.app')

@section('title', catName($category->key))
@section('subtitle', 'Production')
@section('title-icon', catIcon($category->key))

@section('content')

<p>Production en TWh pour les différent scénarios au fil du temps.</p>

@include('parts.graph')

@endsection