<p>Ci dessous le ratio par source d'énergie appliqué aux scénarios en @if (in_array($resource, array_keys(resourcesSpace())))ha @else T @endif/ @if (in_array($resource, array_keys(resourcesFuel())))TWh produit @else MW déployé @endif au fil des décennies selon les hypothèses de RTE:</p>

<div class="container">
    <div class="row">
        <div class="col-4 text-right">
            <b>Source</b>
        </div>
        <div class="col-2 text-right">
            <b>2020</b>
        </div>
        <div class="col-2 text-right">
            <b>2030</b>
        </div>
        <div class="col-2 text-right">
            <b>2040</b>
        </div>
        <div class="col-2 text-right">
            <b>2050</b>
        </div>
    </div>

    @foreach (['nuc', 'newnuc', 'hydro', 'wind', 'hydrowind', 'gas', 'sun', 'coal'] as $category)
        @if (resourceIntensityRTE($category, $resource, 2020) + resourceIntensityRTE($category, $resource, 2030)
            + resourceIntensityRTE($category, $resource, 2040) + resourceIntensityRTE($category, $resource, 2050)
            > 0)
            <div class="row">
                <div class="col-4 text-right">
                    {{ catName($category) }}
                </div>
                <div class="col-2 text-right">
                    {{ resourceIntensityRTE($category, $resource, 2020) }}
                </div>
                <div class="col-2 text-right">
                    {{ resourceIntensityRTE($category, $resource, 2030) }}
                </div>
                <div class="col-2 text-right">
                    {{ resourceIntensityRTE($category, $resource, 2040) }}
                </div>
                <div class="col-2 text-right">
                    {{ resourceIntensityRTE($category, $resource, 2050) }}
                </div>
            </div>
        @endif
    @endforeach
</div>

<p class="mt-3">
    <i class="fa-solid fa-link"></i>
    <a href="https://www.rte-france.com/analyses-tendances-et-prospectives/bilan-previsionnel-2050-futurs-energetiques" target="_blank">
        Source: RTE 2020 - Annexes: Chapitre 12-3 et 12-4
    </a>
</p>

<p>Ainsi que le ratio par source d'énergie appliqué aux scénarios en @if (in_array($resource, array_keys(resourcesSpace())))ha @else T @endif/ @if (in_array($resource, array_keys(resourcesFuel())))TWh produit @else MW déployé @endif selon les hypothèses de l'AIE:</p>

<div class="container">
    <div class="row">
        <div class="col-4 text-right">
            <b>Source</b>
        </div>
        <div class="col-2 text-right">
            <b>2022</b>
        </div>
    </div>

    @foreach (['nuc', 'newnuc', 'hydro', 'wind', 'hydrowind', 'gas', 'sun', 'coal'] as $category)
        @if (resourceIntensityIEA($category, $resource) > 0)
            <div class="row">
                <div class="col-4 text-right">
                    {{ catName($category) }}
                </div>
                <div class="col-2 text-right">
                    {{ resourceIntensityIEA($category, $resource) }}
                </div>
            </div>
        @endif
    @endforeach
</div>

<p class="mt-3">
    <i class="fa-solid fa-link"></i>
    <a href="https://www.iea.org/data-and-statistics/charts/minerals-used-in-clean-energy-technologies-compared-to-other-power-generation-sources" target="_blank">
        Source: AIE 2011 - Minerals used in clean energy technologies compared to other power generation sources
    </a>
</p>