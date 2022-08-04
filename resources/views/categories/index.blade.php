@extends('layouts.app')

@section('content')

<div class="row row-cols-1 row-cols-md-3 g-4">
    @foreach($categories as $category)
        <div class="col">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title"><i class="fa-solid {{ catIcon($category->key)}}"></i> {{ catName($category->key) }}</h5>
                    <p class="card-text">
                        <a href="{{ route('categories.show', $category->key) }}" >
                            <i class="fa-solid fa-chart-line"></i> Évolution dans le temps
                        </a>
                    </p>
                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection