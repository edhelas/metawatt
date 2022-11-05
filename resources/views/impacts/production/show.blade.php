@extends('layouts.app')

@section('title', 'Électricité totale produite')

@section('content')

@include('parts.missing_fossils_ademe')

@include('parts.graph')

@endsection