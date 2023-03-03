<div class="alert">
    <i class="fa-solid fa-circle-info text-info mr-2"></i> L'année 2020 ayant été marquée par l'épidémie du COVID la production électrique a été exceptionnellement basse par rapport aux autres années. <b class="text-info">Les données <a href="https://bilan-electrique-2021.rte-france.com/production_totale/" target="_blank">de production de 2021 on été prises comme référence</a> pour la production issue du charbon et fioul.</b><br />
    <i class="fa-solid fa-circle-info text-info mr-2"></i> Un mix progressif bio-gaz a été appliqué à l'ensemble des scénarios. <b class="text-info">Il est issue du scénario negaWatt 2022.</b><br />
    <!--<i class="fa-solid fa-circle-info text-danger mr-2"></i> Nous n'avons pas, pour le moment, les données sur les différents mix gaziers des scénarios. Les émissions carbones du gaz réseau <b class="text-danger">sont donc calculés sur une base 100% fossile</b> là où de nombreux scénarios tendent vers des mix avec une part importante de bio-gaz.</b>-->

    <div class="container">
        <div class="row">
            <div class="col-2 text-left">
                <b>2020</b>
            </div>
            <div class="col-2 text-left">
                <b>2030</b>
            </div>
            <div class="col-2 text-left">
                <b>2040</b>
            </div>
            <div class="col-2 text-left">
                <b>2050</b>
            </div>
        </div>

        <div class="row">
            <div class="col-2 text-left">
                {{ negaWattBiogasRatio(2020) * 100 }}%
            </div>
            <div class="col-2 text-left">
                {{ negaWattBiogasRatio(2030) * 100 }}%
            </div>
            <div class="col-2 text-left">
                {{ negaWattBiogasRatio(2040) * 100 }}%
            </div>
            <div class="col-2 text-left">
                {{ negaWattBiogasRatio(2050) * 100 }}%
            </div>
        </div>
    </div>
</div>