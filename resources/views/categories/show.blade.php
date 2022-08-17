@extends('layouts.app')

@section('title', catName($category->key))
@section('title-icon', catIcon($category->key))

@section('content')

@include('parts.graph')

@endsection