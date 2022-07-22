@extends('layouts.app', ['mainclass' => 'welcome'])

@section('content')
<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center">
    <div class="col-md-5 p-lg-5 mx-auto my-5">
        <h1 class="display-4 fw-normal">Metawatt</h1>
        <p class="lead fw-normal">Découvrez et comparez les scénarios de transition énergétique</p>
        <a class="btn btn-secondary" href="{{route('scenarios.index')}}">Explorer les scénarios</a>
    </div>
    <div class="product-device shadow-sm d-none d-md-block"></div>
    <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
</div>

<div class="pt-5 text-center">
    <p>Metawatt présente et compare les scénarios énergétiques français.</p>

    <hr />
    <p>Les données représentées sur ce site peuvent comporter des erreurs ou des imprécisions.<br />N'hésitez pas à les notifier et/ou à les corriger directement en contribuant au projet.</p>
</div>
@endsection