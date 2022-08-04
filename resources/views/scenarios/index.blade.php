@extends('layouts.app')

@section('content')

@foreach ($groups as $group => $scenarios)
    <h2>{{ groupName($group) }} <small class="text-muted">{{ groupNameSecond($group) }}</small></h2>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($scenarios as $scenario)
            <div class="col">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">{{$scenario->name}}</h5>
                        <p class="card-text">
                            <a href="{{ route('scenarios.show.production', $scenario->id) }}">
                                <i class="fa-solid fa-chart-line"></i> Production
                            </a><br />
                            <a href="{{ route('scenarios.show.capacity', $scenario->id) }}">
                                <i class="fa-solid fa-chart-line"></i> Capacité
                            </a><br />
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endforeach

@endsection