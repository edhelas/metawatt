@extends('layouts.app')

@section('title', $scenario->name)
@section('subtitle', $scenario->introduction)

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 col-lg-8 mb-4 nopadding">
            @if (!empty(groupLogo($scenario->group)))
            <img class="group_logo" src="{{ groupLogo($scenario->group) }}" />
            @endif

            @if (!empty($scenario->description))
            {!! markdown($scenario->description) !!}
            @endif

            @if (!empty($scenario->goals))
                <h5>Objectifs</h5>

                <ul>
                    @foreach ($scenario->goals as $goal)
                        <li>{{ $goal }}</li>
                    @endforeach
                </ul>
            @endif

            <div class="container">
                <div class="row">
                    <div class="col-12 nopadding">
                        <h5>À l'issue de la transition, l'année 2050:</h5>
                    </div>
                    <div class="col-6 mt-2 mb-4 nopadding">
                        <h4 class="card-title">
                            {{ $totalCarbon }} gCO2eq/kWh
                            <small class="text-muted">émis</small>
                        </h4>
                        <p>
                            {{ compareCarbon2021($totalCarbon) }}% <span class="text-muted"> des émissions moyenne de 2020 (<a href="https://ourworldindata.org/grapher/carbon-intensity-electricity?tab=chart&country=~FRA">58gCO2eq/kWh</a>)</span>
                        </p>
                        <a href="{{ route('impacts.carbon.show.final') }}" class="btn btn-secondary btn-sm">
                            <i class="fa-solid fa-chart-bar"></i> Comparateur carbone
                        </a>
                    </div>
                    <!--<div class="col-6 mt-2 nopadding">
                        <h4 class="card-title">
                            {{ $totalSpace }} ha
                            <small class="text-muted"> artificialisés</small>
                        </h4>
                        <p class="mt-1">
                            {{ compareParis($totalSpace) }}x <span class="text-muted">la superficie de
                            <a href="https://fr.wikipedia.org/wiki/Paris" title="105,40 km2">Paris</a></span>
                        </p>
                        <a href="{{ route('impacts.resources.show', 'artificialization') }}" class="btn btn-secondary btn-sm">
                            <i class="fa-solid fa-chart-bar"></i> Comparateur
                        </a>
                    </div>-->
                    @if ($finalConsumption && $finalConsumption->production > 0)
                        <div class="col-6 mt-2 nopadding">
                            <h4 class="card-title">
                                {{ sobrietyPercentage($finalConsumption->production)  }}%
                                <small class="text-muted"> de consommation<br />d'énergie finale</small>
                            </h4>
                            <p>
                                <small class="text-muted">par rapport à la <a target="_blank" href="https://www.statistiques.developpement-durable.gouv.fr/edition-numerique/chiffres-cles-energie-2021/6-bilan-energetique-de-la-france">consommation de 2021</a></small>
                            </p>
                        </div>
                    @endif
                    <div class="col-6 nopadding">
                        <h4 class="card-title">
                            {{ $totalCapacity }} GW
                            <small class="text-muted">de capacité <i class="fa-solid fa-bolt text-warning"></i> déployée</small>
                        </h4>
                        <p>
                            <i style="color: {{ catColor('lowcarbon') }};" class="fa-solid fa-leaf"></i>
                            {{ $totalLowCarbon }} GW
                            <span class="text-muted">bas carbone, soit {{ percentage($totalLowCarbon, $totalCapacity) }}%</span>
                            <br />
                            <i style="color: {{ catColor('renewable') }};" class="fa-solid fa-arrows-spin"></i>
                            {{ $totalRenewable }} GW
                            <span class="text-muted">renouvelable, soit {{ percentage($totalRenewable, $totalCapacity) }}%</span>
                        </p>
                        <a href="{{ route('scenarios.show.capacity', $scenario->slug) }}"
                            class="btn btn-secondary btn-sm">
                            <i class="fa-solid fa-chart-line"></i> Capacité
                        </a>
                    </div>
                    <div class="col-6 nopadding">
                        <h4 class="card-title">
                            {{ $totalProduction }} TWh
                            <small class="text-muted">d'<i class="fa-solid fa-bolt text-warning"></i> produite</small>
                        </h4>

                        @if ($finalConsumption && $finalConsumption->production > 0)
                            <p>
                                sur {{ $finalConsumption->production }} TWh <span class="text-muted">d'énergie totale consommée soit</span> {{ percentage($totalProduction, $finalConsumption->production) }}% <span class="text-muted">d'électrification</span>
                            </p>
                        @endif

                        <a href="{{ route('scenarios.show.energy', $scenario->slug) }}"
                            class="btn btn-secondary btn-sm">
                            <i class="fa-solid fa-chart-line"></i> Énergies
                        </a>
                    </div>

                    <div class="col-12 mt-4 nopadding">
                        <h4>Évolution du parc <i class="fa-solid fa-bolt text-warning"></i> <small class="text-muted">entre aujourd'hui et 2050 en GW</small></h4>
                    </div>
                        @foreach($categories as $category)
                            @php($evolution = $scenario->evolutionCapacity($category->key))

                            @if ($evolution != 0)

                            <div class="col-3 text-right ">
                                <a href="{{ route('categories.show.capacity', $category->key) }}">{{ $category->title }}</a>
                            </div>
                            <div class="col-2 text-right">
                                @if ($evolution > 0)+@endif{{ number_format($evolution, 2) }}
                            </div>
                            <div class="col-7">
                                @if ($evolution > 0)
                                    @for ($i = 0; $i < $evolution; $i++)
                                        <i style="color: {{ $category->color }};" class="fa-solid {{ catIcon($category->key)}}"></i>
                                    @endfor
                                @else
                                    @for ($i = 0; $i > $evolution; $i--)
                                        <i style="color: {{ $category->color }}; opacity: 0.2;" class="fa-solid {{ catIcon($category->key)}}"></i>
                                    @endfor
                                @endif
                            </div>
                            @endif
                        @endforeach
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4 mb-4 text-center nopadding">
            <h5>L'année 2050</h5>
            <p>Capacité déployée & production correspondante</p>
            @include('parts.graph', ['style' => 'height: 60vh;'])
        </div>

        <div class="col-12">
            @include('parts.group_sources', ['group' => $scenario->group])
        </div>

        <div class="col-12 col-md-6">
            @if ($previousScenario)
            @include('parts.scenario_card', ['scenario' => $previousScenario])
            @endif
        </div>
        <div class="col-12 col-md-6">
            @if ($nextScenario)
            @include('parts.scenario_card', ['scenario' => $nextScenario])
            @endif
        </div>
    </div>
</div>


@endsection