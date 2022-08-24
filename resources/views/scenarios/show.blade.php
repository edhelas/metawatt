@extends('layouts.app')

@section('title', $scenario->name)
@section('subtitle', $scenario->introduction)

@section('content')

<div class="container">
    <div class="row g-0">
        <div class="col-12 col-lg-4">
            @if (!empty(groupLogo($scenario->group)))
                <img class="group_logo" src="{{ groupLogo($scenario->group) }}" />
            @endif

            @if (!empty($scenario->description))
                {!! markdown($scenario->description) !!}
            @endif

            <a href="{{ route('scenarios.show.production', $scenario->id) }}" class="btn btn-secondary mr-2">
                <i class="fa-solid fa-chart-line"></i> Production
            </a>
            <a href="{{ route('scenarios.show.capacity', $scenario->id) }}" class="btn btn-secondary">
                <i class="fa-solid fa-chart-line"></i> Capacité
            </a>
        </div>
        <div class="col-12 col-md-6 col-lg-4 text-center">
            <p>Capacité en 2050 <span class="text-muted">GW</span></p>
            @include('parts.graph')
        </div>
        <div class="col-12 col-md-6 col-lg-4 text-center">
            <p>Production en 2050 <span class="text-muted">TWh</span></p>
            @include('parts.graph2')
        </div>
    </div>
</div>


@endsection