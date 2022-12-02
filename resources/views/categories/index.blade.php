@extends('layouts.app')

@section('title', 'Énergies')
@section('subtitle', "Les sources d'énergies des scénarios")

@section('content')

<p>Metawatt compare pour chaque source d'énergie retenues par les scénarios compilés, les production, capacité et facteur de charge.</p>

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
                    <a href="{{ route('categories.show.capacity', $category->key) }}">Capacité déployée dans le temps</a><br />

                    @if ($category->key != 'step')
                        <i class="fa-solid fa-chart-line"></i>
                        <a href="{{ route('categories.show.production', $category->key) }}">Volume produit dans le temps</a><br />

                        <i class="fa-solid fa-chart-line"></i>
                        <a href="{{ route('categories.show.load.factor', $category->key) }}">Évolution du facteur de charge</a>
                    @endif
                </p>

                @include('parts.category_types_card', ['category' => $category])
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection