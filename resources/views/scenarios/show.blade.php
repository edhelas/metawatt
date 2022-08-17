@extends('layouts.app')

@section('title', $scenario->name)
@section('subtitle', typeName($type))

@section('content')

@include('parts.graph')

@endsection