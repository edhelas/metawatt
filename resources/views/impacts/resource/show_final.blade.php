@extends('layouts.app')

@section('title', 'Impact final')
@section('subtitle', $resources[$resource])

@section('content')

@if (in_array($resource, array_keys(resourcesSpace())))
<p>Occupation en hectares final pour chaque scénario envisagé en {{ $year }}</p>
<p>
    Sont représentées les surfaces <b>mobilisées</b> l'année {{ $year }}. Ce graphique ne tiens pas compte des surfaces précédement utilisées (démantèlement, abandon d'infrastructure).</p>
</p>
@elseif(in_array($resource, array_keys(resourcesFuel())))
<p>Consommation de la resource finale en tonnes pour chaque scénario envisagé l'année {{ $year }}</p>
@else
<p>Mobilisation de la resource finale en tonnes pour chaque scénario envisagé l'année {{ $year }}</p>
<p>
    Sont représentées les ressources <b>mobilisées</b> l'année {{ $year }}. Ce graphique ne tiens pas compte de la
    ressource précédement utilisée (démantèlement, abandon d'infrastructure) ni du recyclage.</p>
</p>
@endif

<p>Le losange blanc ⬦ présente la production totale d'électricité à l'issue de la transition en {{ $year }}</p>

@include('parts.lifetime_infrastructure')

@include('parts.graph')

@if($resource != 'space')
    <p>Nous avons ici projeté la capacité de chaque source d'énergie au fil des années par scénario et estimé la quantité de
        resource nécessaire à son déploiement.</p>

    @include('parts.sources_resource_impact')
@endif

@endsection