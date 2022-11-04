@extends('layouts.app')

@section('title', 'Énergies')
@section('subtitle', "Les sources d'énergies des scénarios")

@section('content')

<p>Les scénarios compilés par Metawatt développent différentes sources d'énergies qui sont présentées ici.</p>

<div class="row row-cols-1 row-cols-md-3 g-4">
    @foreach($categories as $category)
    <div class="col">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">
                    <i style="color: {{ catColor($category->key) }};"
                        class="fa-solid {{ catIcon($category->key)}}"></i>
                    {{ catName($category->key)}}
                </h5>
                <p class="card-text">
                    <i class="fa-solid fa-chart-line"></i>
                    <a href="{{ route('categories.show.production', $category->key) }}">Production dans le temps</a><br />

                    <i class="fa-solid fa-chart-line"></i>
                    <a href="{{ route('categories.show.capacity', $category->key) }}">Capacité déployée dans le temps</a><br />

                    <i class="fa-solid fa-chart-line"></i>
                    <a href="{{ route('categories.show.load.factor', $category->key) }}">Évolution du facteur de charge</a>
                </p>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection