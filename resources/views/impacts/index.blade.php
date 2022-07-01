@extends('layouts.app')

@section('content')

<ul class="list-group">
    @foreach($resources as $key => $name)
        <a href="{{ route('impacts.resources.show', $key) }}" class="list-group-item list-group-item">
            {{ $name }}
        </a>
    @endforeach
</ul>

@endsection