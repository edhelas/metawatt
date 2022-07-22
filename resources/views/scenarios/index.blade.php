@extends('layouts.app')

@section('content')
@foreach ($groups as $group => $scenarios)

    <h2>{{ groupName($group) }} <small class="text-muted">{{ groupNameSecond($group) }}</small></h2>

    <ul class="list-group mb-3 mt-3">
        @foreach($scenarios as $scenario)
        <li class="list-group-item list-group-item">
            <h5>{{$scenario->name}}</h5>
            <p class="mb-0"><a href="{{ route('scenarios.show.production', $scenario->id) }}">Production</a> - <a
                    href="{{ route('scenarios.show.capacity', $scenario->id) }}">Capacité</a></p>
        </li>
        @endforeach
    </ul>
@endforeach

@endsection