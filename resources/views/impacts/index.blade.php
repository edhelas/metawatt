@extends('layouts.app')

@section('content')

<p>Impact des différent scénarios sur la mobilisation de resources contraintes</p>

<ul class="list-group">
    @foreach($resources as $key => $name)
        <a href="{{ route('impacts.resources.show', $key) }}" class="list-group-item list-group-item">
            {{ $name }}
        </a>
    @endforeach
</ul>

@endsection