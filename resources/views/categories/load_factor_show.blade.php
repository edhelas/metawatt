@extends('layouts.app')

@section('content')

<h1><i class="fa-solid {{ catIcon($category->key)}}"></i> {{ catName($category->key) }}
    <small class="text-muted">Facteur de charge</small>
</h1>

<p>Évolution du facteur de charge en pourcent au fil des décennies.</p>

@include('parts.graph')

@endsection