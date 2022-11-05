@extends('layouts.app')

@section('title', 'Électricité totale produite')

@section('content')

<p>Production totale en électricité en TWh à l'issue de la transition en {{ $year }}.</p>

@include('parts.missing_fossils_ademe')

@include('parts.graph')

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
                    <span title="{{ catName($category)}} - {{ percentage($value, $data['total']) }}%" class="bar"
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

@endsection