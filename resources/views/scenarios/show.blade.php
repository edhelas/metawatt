@extends('layouts.app')

@section('title', $scenario->name)
@section('subtitle', $scenario->introduction)

@section('content')

<p>{{ $scenario->description }}</p>

<div class="container text-center">
    <div class="row">
        <div class="col" style="width: 50%;">
            <h5>Capacité en 2050</h5>
            <p class="text-muted">en GW</p>
            @include('parts.graph')
        </div>
        <div class="col" style="width: 50%;">
            <h5>Production en 2050</h5>
            <p class="text-muted">en TWh</p>
            @include('parts.graph2')
        </div>
    </div>
</div>


@endsection