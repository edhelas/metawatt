@extends('layouts.app')

@if ($resource)
    @section('title', 'Consommation de la ressource')
    @section('subtitle', $resources[$resource])
@else
    @section('title', 'Électricité totale produite')
@endif

@section('content')

@if ($resource)
    <p>Volume totale de la ressource consommée en T à l'issue de la transition en {{ $year }}.</p>
@else
    <p>Production totale en électricité en TWh à l'issue de la transition en {{ $year }}.</p>
@endif

@if ($resource == false)
    @include('parts.gas_mix')
@endif

@include('parts.graph')

@if ($resource == false)
    <hr />

    <h3>Part de production</h3>

    <p>Part en % des différentes sources d'électricité dans la production totale de aujourd'hui jusqu'en {{ $year }}.</p>

    <table class="table table-sm table-borderless text-right">
        <thead>
            <tr>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($percentages as $scenario => $data)
            <tr>
                <th style="width: 20%;" class="line">
                    <b>{{ $scenario }}</b>
                </th>
                <td style="width: 80%;">
                    @foreach ($data as $category => $value)
                        @if ($category != 'total')
                        <span title="{{ catName($category) }} - {{ percentage($value, $data['total']) }}%" class="bar"
                            style="width: {{ percentage($value * 0.99, $data['total']) }}%; background-color: {{ catColor($category) }};">
                            @if (percentage($value, $data['total']) > 3)
                                {{ percentage($value, $data['total']) }}%
                            @endif
                        </span>
                        @endif
                    @endforeach
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endif

@endsection