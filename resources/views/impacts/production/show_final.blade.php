@extends('layouts.app')

@section('title', 'Électricité totale produite')

@section('content')

<p>Production totale en électricité en TWh à l'issue de la transition en {{ $year }}.</p>

@include('parts.graph')

@endsection