@extends('layouts.app')

@section('title', 'Découvrir')
@section('subtitle', 'Les grands principes')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 col-lg-7 mb-4 nopadding">
            <h3>Un objectif, la neutralité carbone en 2050</h3>

            <p>Afin de contenir l'augmentation de la température moyenne de la planète bien en dessous de 2 °C et de préférence de limiter l'augmentation à 1,5 °C par rapport à l'ère pré-industrielle la France s'est engagée en 2015 à respecter l'objectif signé lors de l'<a href="https://fr.wikipedia.org/wiki/Accord_de_Paris_sur_le_climat">Accord de Paris sur le Climat</a>.</p>

            <p>Cet objectif a été formalisé au sein de la SNBC. Adoptée pour la première fois en 2015, la SNBC a été révisée en 2018-2019, en visant d’atteindre la neutralité carbone en 2050 (ambition rehaussée par rapport à la première SNBC qui visait le facteur 4, <b>soit une réduction de 75 %</b> de ses émissions GES à l'horizon 2050 par rapport à 1990)</p>

            <div class="alert ">
                <i class="fa-solid fa-circle-info text-info mr-2"></i> La SNBC, <a href="https://www.ecologie.gouv.fr/sites/default/files/19092_strategie-carbone-FR_oct-20.pdf">Stratégie Nationale Bas-Carbone"</a> est la feuille de route de la France pour réduire ses émissions de gaz à effet de serre (GES). Elle concerne tous les secteurs d'activité et doit être portée par tous : citoyens, collectivités et entreprises. Deux ambitions : <b>atteindre la neutralité carbone dès 2050 et réduire l'empreinte carbone des Français.</b>
            </div>

            <p>Les émissions françaises son répartit dans différents secteurs clefs. Metawatt présente et compare le secteur de production d'énergie des différents scénarios proposés par instances publiques, associations et industriels.</p>
        </div>
        <div class="col-12 col-lg-5 text-center nopadding">
            @include('parts.graph', ['style' => 'height: auto;'])
            <p>Émissions de CO2 par secteur en 2021<br />(en mTeqCO2)</p>
        </div>
    </div>

    <div class="row">
        <div class="col-12 nopadding">
            <h3>Plusieurs leviers pour décarbonner</h3>

            <p>Afin d'atteindre nos objectifs de réduction de nos émissions trois grands leviers peuvent être mis en avant:</p>
        </div>

        <div class="col-12 col-lg-6 mb-4 nopadding">
            <h4>1. L'efficacité</h4>

            <p>L'amélioration des techniques permet de limiter les pertes liées à leurs usages et ainsi de rendre plus efficiente nos objets et machines du quotidien.</p>

            <div class="alert">
                <i class="fa-solid fa-circle-info text-info mr-2"></i> Un moteur thermique ne transforme qu'au mieux environ <b>30%</b> de l'énergie contenue dans le combustible utilisé (le reste étant perdu en chaleur) là où un moteur électrique utilise plus de <b>90%</b> de l'énergie électrique injectée en force motrice. Dit autrement, il faut environ 3 fois moins d'énergie pour faire avancer une voiture électrique qu'une voiture thermique.
                <br /><br />
                <i class="fa-solid fa-circle-info text-info mr-2"></i> En améliorant l'isolation thermique d'un bâtiment nous pouvons réduire sa consommation d'énergie totale pour le chauffer ou le refroidir, qu'elle soit de nature électrique (climatisation, radiateur électrique, pompe à chaleur...) que par combustion (poêle à bois ou granulés...).</p>
            </div>

            <p>Les différents <a href="{{ route('scenarios.index') }}">scénarios analysés sur Metawatt</a> proposent plusieurs visions où ces améliorations techniques et changement de parc sont déployés sur notre territoire. Certains scénarios estiment que certaines améliorations techniques futures seront limitées alors que d'autres font de nombreux paris technologiques.</p>

            <p>L'efficacité est bien souvent le premier levier qui est utilisé afin de réduire nos consommations d'énergie. Nous avons néanmoins tendance à augmenter par la suite l'usage de ces objets ou machines, annulant une partie ou la totalité du gain engendré par les améliorations d'efficacité apportées.</p>

            <p>Par exemple le gain d'efficacité issue des améliorations techniques des moteurs des véhicules thermiques de ces dernières décennies a été gommé par l'augmentation de l'usage de ces même véhicules ainsi que par l'augmentation de leur poids moyen total. Nous parlons alors <a href="https://fr.wikipedia.org/wiki/Effet_rebond_(%C3%A9conomie)">d'effet rebond</a>.</p>
        </div>

        <div class="col-12 col-lg-6 mb-4">
            <h4>2. La sobriété</h4>

            <p>La sobriété énergétique est la diminution des consommations d'énergie par des changements de modes de vie et des transformations sociales. Ce concept politique se traduit notamment par la limitation de la production et de la consommation des biens et services à un niveau bas mais suffisant.</p>

            <p>Les objectifs fixés par la SNBC ne peuvent pas être atteint uniquement par l'amélioration de l'efficacité de nos machines. De nombreux comportements et modes de consommation devront changer afin de s'assurer que nous restons dans les trajectoires.</p>

            <p>Tout comme pour l'efficacité, certains des scénarios proposent des trajectoires où nos usages resteront plus ou moins constant dans le temps là où d'autres poussent de nombreux plans de réduction et réorganisation de nos consommations et usages.</p>

            <p>La sobriété ne doit pas être uniquement perçue comme une limitation. Par exemple mieux anticiper ses déplacements et voyager avec des modes de transports plus efficaces (train, vélo) peut être considéré comme une forme de sobriété.</p>
        </div>

    <h4>3. La réduction des émissions carbones de nos sources d'énergie</h4>

    <p>Pour finalement s'assurer d'atteindre l'objectif de l'Accord de Paris l'efficacité et la sobriété ne suffiront pas. Il nous faut nous assurer que les machines et outils dont nous faisons usage, même de façon plus sobre, fonctionnent avec des énergies qui n'émettent pas ou peu de CO2.</p>

    <div class="alert">
        <i class="fa-solid fa-circle-info text-info mr-2"></i> Si nous électrifions massivement nos transports (gain en efficacité) et que nous réduisons certains de nos usages (sobriété) nous devons nous assurer que l'électricité utilisée dans ces véhicules émette peu de CO2 lors de sa production.
    </div>

    <p>Metawatt compare donc <a href="{{ route('scenarios.index') }}">l'évolution du mix énergétique des différents scénarios</a> ainsi <a href="{{ route('impacts.resources.index')}}">que leurs différents impacts</a> (<a href="{{ route('impacts.carbon.show.final') }}">carbone</a>, matériaux…) au fil des décennies.</p>

    </div>
</div>
@endsection