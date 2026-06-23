@extends('layouts.app')

@section('title', 'Scénarios & PPE')

@section('content')

    <h2>{{ groupName('ppe') }} <small class="text-muted">{{ groupNameSecond('ppe') }}</small></h2>

        <img class="group_logo" src="{{ groupLogo('ppe') }}"/>

    <p>{!! groupIntroduction('ppe') !!}</p>

    <div class="row row-cols-1 row-cols-md-3 g-4 mb-3" style="clear: both;">
            <div class="col">
                @include('parts.scenario_card', ['scenario' => $ppe])
            </div>
    </div>

    @include('parts.group_sources', ['group' => 'ppe'])

    <hr class="mb-4 mt-4"/>

<p>Retrouvez ici tous les scénarios compilés par Metawatt ainsi que leurs caractéristiques</p>

@foreach ($groups as $group => $scenarios)
    <h2>{{ groupName($group) }} <small class="text-muted">{{ groupNameSecond($group) }}</small></h2>

    @if (!empty(groupLogo($group)))
        <img class="group_logo" src="{{ groupLogo($group) }}"/>
    @endif

    <p>{!! groupIntroduction($group) !!}</p>

    <div class="row row-cols-1 row-cols-md-3 g-4 mb-3" style="clear: both;">
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