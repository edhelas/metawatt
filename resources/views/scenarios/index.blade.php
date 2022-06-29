@extends('layouts.app')

@section('content')

@foreach($scenarios as $scenario)
<li class="list-group-item list-group-item">
    {{$scenario->name}} <a href="{{ route('scenarios.show.production', $scenario->id) }}">Production</a> -  <a href="{{ route('scenarios.show.capacity', $scenario->id) }}">Capacité</a>
</li>
@endforeach

@endsection