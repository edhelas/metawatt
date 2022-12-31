@extends('layouts.app')

@section('title', 'Énergies')
@section('subtitle', "La gestion des énergies dans les différents scénarios")

@section('content')

<h2>La production électrique</h2>

<p>Metawatt compile et compare les production, capacité et facteur de charge des différentes sources d'électricité des scénarios.</p>

<div class="row row-cols-1 row-cols-md-3 g-4">
    @foreach($categories as $category)
        <div class="col">
            @include('parts.category_index_card', ['category' => $category])
        </div>
    @endforeach
</div>

<h2>Le stockage de l'électricité</h2>

<p>Afin de gérer l'intermittence des renouvelable et les variations de la demande électrique les scénarios envisagent de déployer différentes technologies afin de stocker l'électricité.</p>

<div class="row row-cols-1 row-cols-md-3 g-4">
    @foreach($storage as $category)
        <div class="col">
            @include('parts.category_index_card', ['category' => $category])
        </div>
    @endforeach
</div>


@endsection