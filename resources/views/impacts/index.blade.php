@extends('layouts.app')

@section('content')

<h3>Carbone</h3>

<p>Impact carbone des différents scénarios au fil du temps</p>

<ul class="list-group">
    <a href="{{ route('impacts.carbon.show') }}" class="list-group-item list-group-item">
        Carbone
    </a>
</ul>

<h3 class="mt-3">Artificialisation & Matière</h3>

<p>Impact des différent scénarios sur la mobilisation de resources contraintes</p>

<ul class="list-group">
    @foreach($resources as $key => $name)
        <a href="{{ route('impacts.resources.show', $key) }}" class="list-group-item list-group-item">
            {{ $name }}
        </a>
    @endforeach
</ul>

@endsection