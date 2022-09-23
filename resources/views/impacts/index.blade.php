@extends('layouts.app')

@section('title', 'Impact')

@section('content')

<div class="row">
    <div class="col-12">
        <p>Nous comparons ici certains des impacts en ressources ou sur l'environnement des différents scénarios compilés par Metawatt.</p>
    </div>

    <div class="col-12 col-lg-6">
        <h3>Production totale</h3>
        <p>Électricité totale produite au fil du temps</p>
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Électricité totale produite</h5>
                <p class="card-text">
                    <i class="fa-solid fa-chart-line"></i>
                    <a href="{{ route('impacts.show.production.total') }}">Évolution dans le temps</a>
                </p>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-6">
        <h3>Carbone</h3>
        <p>Impact carbone des différents scénarios au fil du temps</p>
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Carbone</h5>
                <p class="card-text">
                    <i class="fa-solid fa-chart-column"></i>
                    <a href="{{ route('impacts.carbon.show') }}">Impact final en 2050</a>
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
                        <i class="fa-solid fa-chart-line"></i>
                        <a href="{{ route('impacts.resources.show', $key) }}">Évolution dans le temps</a><br />

                        <i class="fa-solid fa-chart-column"></i>
                        <a href="{{ route('impacts.resources.show.final', $key) }}">Impact final en 2050</a>
                    </p>
                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection