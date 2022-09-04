@extends('layouts.app', ['mainclass' => 'welcome'])

@section('content')
<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center">
    <div class="col-md-5 p-lg-6 mx-auto my-5">
        <h1 class="display-4 fw-normal">Metawatt</h1>
        <p class="lead fw-normal">Découvrez et comparez les scénarios de transition énergétique électrique</p>
        <a class="btn btn-secondary" href="{{route('info.discover')}}"><i class="fa-solid {{ catIcon('metawatt')}} mr-2"></i> Découvrir</a>
    </div>
    <div class="product-device shadow-sm d-none d-md-block"></div>
    <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
</div>

<div class="pt-5 text-center">
    <div id="logos" class="mt-4">
        <a href="https://www.rte-france.com/analyses-tendances-et-prospectives/bilan-previsionnel-2050-futurs-energetiques" target="_blank">
            <img src="img/rte.svg">
        </a>
        <a href="https://www.ademe.fr/les-futurs-en-transition/les-scenarios/" target="_blank">
            <img src="img/ademe.svg">
        </a>
        <a href="https://negawatt.org/Scenario-negaWatt-2017-2050">
            <img src="img/negawatt.jpg" target="_blank">
        </a>
    </div>
    <p>Metawatt présente et compare les scénarios énergétiques français pour le volet production électrique.</p>

    <hr />
    <p>Les données représentées sur ce site peuvent comporter des erreurs ou des imprécisions.<br />N'hésitez pas à les notifier et/ou à les corriger directement en contribuant au projet.</p>
</div>
@endsection