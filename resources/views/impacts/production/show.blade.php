@extends('layouts.app')

@section('title', 'Électricité totale produite')

@section('content')

@include('parts.gas_mix')

@include('parts.graph')

@endsection