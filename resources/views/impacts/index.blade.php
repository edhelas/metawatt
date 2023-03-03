@extends('layouts.app')

@section('title', 'Impact')

@section('content')

<div class="row">
    <div class="col-12">
        <p>Comparez ici certains des impacts en ressources ou sur l'environnement des différents scénarios compilés par Metawatt.</p>
    </div>

    <div class="col-12 col-lg-6">
        <h3>Production totale</h3>
        <p>Électricité totale produite au fil du temps</p>
        <div class="card mb-4">
            <img src="{{ resourceImage('electricity') }}" class="card-img-top">
            <div class="card-body">
                <h5 class="card-title">Électricité totale produite</h5>
                <p class="card-text">
                    <i class="fa-solid fa-chart-line"></i>
                    <a href="{{ route('impacts.production.show') }}">Évolution dans le temps</a><br />

                    <i class="fa-solid fa-chart-column"></i>
                    <a href="{{ route('impacts.production.show.final') }}">Production totale en 2050</a>
                </p>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-6">
        <h3>Carbone</h3>
        <p>Impact carbone des différents scénarios au fil du temps</p>
        <div class="card mb-4">
            <img src="{{ resourceImage('carbon') }}" class="card-img-top">
            <div class="card-body">
                <h5 class="card-title">Carbone</h5>
                <p class="card-text">
                    <i class="fa-solid fa-chart-line"></i>
                    <a href="{{ route('impacts.carbon.show') }}">Émissions dans le temps</a><br />

                    <i class="fa-solid fa-chart-line"></i>
                    <a href="{{ route('impacts.carbon.perkwh') }}">Émission moyenne par kWh dans le temps</a><br />

                    <i class="fa-solid fa-chart-column"></i>
                    <a href="{{ route('impacts.carbon.show.final') }}">Impact total en 2050</a>
                </p>
            </div>
        </div>
    </div>
</div>

<h3 class="mt-3">Usage des sols et surfaces</h3>

<p>Impact des différent scénarios sur l'usage des sols et des surfaces</p>

<div class="row">
    @foreach(resourcesSpace() as $key => $name)
        @if (in_array($key, ['space', 'soil-sealing']))
            @include('parts.impact_index_card', ['key' => $key, 'name' => $name, 'evolution' => false])
        @endif
    @endforeach
</div>

<h3 class="mt-3">Matière</h3>

<p>Impact des différent scénarios sur la mobilisation de resources contraintes</p>

<div class="row row-cols-1 row-cols-md-3 g-4">
    @foreach(resourcesMaterial() as $key => $name)
        @include('parts.impact_index_card', ['key' => $key, 'name' => $name, 'evolution' => true])
    @endforeach
</div>

<h3 class="mt-3">Combustibles et carburants</h3>

<p>Consommation des différents scénarios en combustibles et carburants</p>

<div class="row row-cols-1 row-cols-md-3 g-4">
    @foreach(resourcesFuel() as $key => $name)
        @include('parts.impact_index_card', ['key' => $key, 'name' => $name, 'evolution' => true])
    @endforeach
</div>

@endsection