@extends('layouts.app')

@section('title', 'Électricité totale produite')

@section('content')

<p>Production totale en électricité en TWh à l'issue de la transition en {{ $year }}.</p>

@include('parts.graph')

<hr />

<h3>Part de production</h3>

<p>Part en % des différentes sources d'électricité dans la production totale au cours du temps jusqu'en {{ $year }}.</p>

<table class="table text-right">
    <thead>
        <tr>
            <th></th>
            @foreach ($percentages[array_key_first($percentages)] as $category => $value)
                @if ($category != 'total')
                <th>
                    {{ $category }}
                </th>
                @endif
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($percentages as $scenario => $data)
        <tr>
            <th>
                <b>{{ $scenario }}</b>
            </th>
            @foreach ($data as $category => $value)
                @if ($category != 'total')
                <td>
                    {{ percentage($value, $data['total']) }}
                </td>
                @endif
            @endforeach
        </tr>
        @endforeach
    </tbody>
</table>

@endsection