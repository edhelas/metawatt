@extends('layouts.app')

@section('title', 'Découvrir')
@section('subtitle', 'Les grands principes')

@section('content')
    <h3>Un objectif, la neutralité carbone en 2050</h3>

    <p>Afin de contenir l'augmentation de la température moyenne de la planète bien en dessous de 2 °C et de préférence de limiter l'augmentation à 1,5 °C par rapport à l'ère pré-industrielle la France s'est engagée en 2015 à respecter l'objectif signé lors de l'<a href="https://fr.wikipedia.org/wiki/Accord_de_Paris_sur_le_climat">Accord de Paris sur le Climat</a>.</p>

    <div class="alert alert-secondary">
        La SNBC, <a href="https://www.ecologie.gouv.fr/sites/default/files/19092_strategie-carbone-FR_oct-20.pdf">Stratégie Nationale Bas-Carbone"</a> est la feuille de route de la France pour réduire ses émissions de gaz à effet de serre (GES). Elle concerne tous les secteurs d'activité et doit être portée par tous : citoyens, collectivités et entreprises. Deux ambitions : <b>atteindre la neutralité carbone dès 2050 et réduire l'empreinte carbone des Français.</b>
    </div>

    <p>Cet objectif a été formalisé au sein de la SNBC. Adoptée pour la première fois en 2015, la SNBC a été révisée en 2018-2019, en visant d’atteindre la neutralité carbone en 2050 (ambition rehaussée par rapport à la première SNBC qui visait le facteur 4, <b>soit une réduction de 75 %</b> de ses émissions GES à l'horizon 2050 par rapport à 1990)</p>

    <h3>Plusieurs leviers pour décarbonner</h3>

    <p>Les émissions françaises son répartit dans différents secteurs clefs. Metawatt présente et compare le secteur de production d'énergie des différents scénarios proposés par instances publiques, associations et industriels.</p>

    <div class="float-right text-center" style="max-width: 50rem; margin-left: 2rem;">
        @include('parts.graph', ['style' => 'height: 20rem;'])
        <p>Émissions de CO2 par secteur en 2021<br />(en mTeqCO2)</p>
    </div>

    <h4>L'efficacité</h4>

    <p>L'amélioration des techniques et de leurs usages permet de limiter les pertes liées et ainsi de rendre plus efficiente l'usage de l'énergie utilisée par nos objets et machines du quotidient.</p>

    <p>Par exemple un moteur thermique ne transforme qu'au mieux environ <b>30%</b> de l'énergie contenue dans le combustible utilisé (le reste étant perdu en chaleur) là où un moteur électrique utilise plus de <b>90%</b> de l'énergie électrique injectée en force motrice. Dit autrement, il faut environ 3 fois moins d'énergie pour faire avancer une voiture électrique qu'une voiture thermique.</p>

    <p>De la même façon en améliorant l'isolation thermique d'un bâtiment nous pouvons réduire sa consommation d'énergie totale pour le chauffer ou le refroidir, qu'elle soit de nature électrique (climatisation, radiateur électrique, pompe à chaleur) que thermique (poêle à bois ou granulé).</p>

    <p>Les différents <a href="{{ route('scenarios.index') }}">scénarios proposés sur Metawatt</a> proposent plusieurs visions où ces améliorations techniques et changement de parc sont déployés sur notre territoire, certains scénarios estiment que certaines améliorations techniques futures seront limitées alors que d'autres font de nombreux paris technologiques.</p>

    <p>L'efficacité est bien souvent le premier levier qui est utilisé afin de réduire nos consommations d'énergie. Néanmoins celui-ci ne réduit que la consommation d'énergie totale qu'à usage constant de l'outil en question. Nous avons souvent tendance à augmenter et exploiter l'usage de cet outil par la suite annulant une partie ou la totalité du gain engendré par les améliorations techniques implémentés.</p>

    <p>Par exemple l'amélioration technique des moteurs des véhicules thermique de ces dernières décennies a été gommé par l'augmentation de l'usage de ces même véhicules ainsi que par l'augmentation de leur poids moyen total. Nous parlons alors <a href="https://fr.wikipedia.org/wiki/Effet_rebond_(%C3%A9conomie)">d'effet rebond</a>.</p>

    <h4>La sobriété</h4>

    <p>La sobriété énergétique est la diminution des consommations d'énergie par des changements de modes de vie et des transformations sociales. Ce concept politique se traduit notamment par la limitation, à un niveau suffisant, des biens et services, produits et consommés.</p>

    <p>Les objectifs fixés par la SNBC ne peuvent pas être atteint uniquement par l'amélioration de l'efficacité de nos machines. De nombreux comportements et modes de devront changer afin de s'assurer que nous restons dans les trajectoires.</p>

    <p>Tout comme pour l'efficacité, certains des scénarios proposent des trajectoires où nos usages resteront plus ou moins constant dans le temps là où d'autres poussent de nombreux plans de réduction et réorganisation de nos consommations et usages.</p>

    <p>La sobriété ne doit pas être uniquement perçue comme une limitation. Par exemple limiter ses déplacements et voyager avec des modes de transports plus efficaces (train, vélo) peut être considéré comme une forme de sobriété.</p>

    <h4>La réduction des émissions carbones de nos sources d'énergie</h4>

    <p>Pour finalement s'assurer d'atteindre l'obectif de l'Accord de Paris l'amélioration technique et la réduction des usages de suffira pas. Il nous faut nous assurer que les machines et outils dont nous faisons usage, même de façon plus sobre fonctionnent avec des énergies qui émettent pas ou peu de CO2.</p>

    <p>Si nous électrifions massivement nos transports (gain en efficacité) et que nous réduisons certains de nos usages (sobriété) nous devons nous assurer que l'électricité utilisée dans ces véhicules émette peu de CO2 lors de cette production.</p>

    <p>Metawatt compare donc <a href="{{ route('scenarios.index') }}">l'évolution du mix énergétique des différents scénarios</a> ainsi <a href="{{ route('impacts.resources.index')}}">que leurs différents impacts</a> (<a href="{{ route('impacts.carbon.show') }}">carbone</a>, matériaux…) au fil des décennies.</p>
@endsection