@extends('layouts.app')

@section('title', 'Scénarios')

@section('content')

<p>Retrouvez ici tous les scénarios compilés par Metawatt ainsi que leurs caractéristiques</p>

@foreach ($groups as $group => $scenarios)
    <h2>{{ groupName($group) }} <small class="text-muted">{{ groupNameSecond($group) }}</small></h2>

    @if (!empty(groupLogo($group)))
        <img class="group_logo" src="{{ groupLogo($group) }}"/>
    @endif

    <p>{!! groupIntroduction($group) !!}</p>

    <div class="row row-cols-1 row-cols-md-3 g-4" style="clear: both;">
        @foreach($scenarios as $scenario)
            <div class="col">
                @include('parts.scenario_card', ['scenario' => $scenario])
            </div>
        @endforeach
    </div>

    @include('parts.group_sources', ['group' => $group])

    <hr class="mb-4 mt-4"/>
@endforeach

@endsection