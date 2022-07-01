@extends('layouts.app')

@section('content')
<ul class="list-group">
    @foreach($scenarios as $scenario)
    <li class="list-group-item list-group-item">
        <h5>{{$scenario->name}}</h5>
        <p class="mb-0"><a href="{{ route('scenarios.show.production', $scenario->id) }}">Production</a> - <a
                href="{{ route('scenarios.show.capacity', $scenario->id) }}">Capacité</a></p>
    </li>
    @endforeach
</ul>

@endsection