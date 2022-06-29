@extends('layouts.app')

@section('content')

<h1><i class="fa-solid {{ catIcon($category->key)}}"></i> {{ catName($category->key) }}</h1>

@include('parts.graph')

@endsection