@extends('layouts.app')

@section('title', 'Impact')

@section('content')

<h3>Production totale</h3>

<p>Énergie totale produite au fil du temps</p>

<div class="row row-cols-1 row-cols-md-3 g-4">
    <div class="col">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Énergie totale produite</h5>
                <p class="card-text">
                    <a href="{{ route('impacts.show.production.total') }}">
                        <i class="fa-solid fa-chart-line"></i> Évolution dans le temps
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>

<h3>Carbone</h3>

<p>Impact carbone des différents scénarios au fil du temps</p>

<div class="row row-cols-1 row-cols-md-3 g-4">
    <div class="col">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Carbone</h5>
                <p class="card-text">
                    <a href="{{ route('impacts.carbon.show') }}">
                        <i class="fa-solid fa-chart-column"></i> Impact final en 2050
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>

<h3 class="mt-3">Artificialisation & Matière</h3>

<p>Impact des différent scénarios sur la mobilisation de resources contraintes</p>

<div class="row row-cols-1 row-cols-md-3 g-4">
    @foreach($resources as $key => $name)
        <div class="col">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">{{ $name }}</h5>
                    <p class="card-text">
                        <a href="{{ route('impacts.resources.show', $key) }}">
                            <i class="fa-solid fa-chart-line"></i> Évolution dans le temps
                        </a><br />
                        <a href="{{ route('impacts.resources.show.final', $key) }}">
                            <i class="fa-solid fa-chart-column"></i> Impact final en 2050
                        </a>
                    </p>
                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection