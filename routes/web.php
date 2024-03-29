<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('scenarios', 'ScenarioController@index')->name('scenarios.index');
Route::get('scenarios/{scenario}/capacity', 'ScenarioController@showCapacity')->name('scenarios.show.capacity');
Route::get('scenarios/{scenario}/energy', 'ScenarioController@showEnergy')->name('scenarios.show.energy');
Route::get('scenarios/{scenario}', 'ScenarioController@show')->name('scenarios.show');

Route::get('energies', 'CategoryController@index')->name('categories.index');
Route::get('energies/{category}/production', 'CategoryController@showProduction')->name('categories.show.production');
Route::get('energies/{category}/capacity', 'CategoryController@showCapacity')->name('categories.show.capacity');
Route::get('energies/{category}/load-factor', 'CategoryController@showLoadFactor')->name('categories.show.load.factor');

Route::get('impact/production', 'ImpactController@production')->name('impacts.production.show');
Route::get('impact/production/final', 'ImpactController@productionFinal')->name('impacts.production.show.final');
Route::get('impact/consumption/{resource}/final', 'ImpactController@productionFinal')->name('impacts.consumption.show.final');
Route::get('impact/carbon', 'ImpactController@carbon')->name('impacts.carbon.show');
Route::get('impact/carbon/per-kwh', 'ImpactController@carbonPerkWh')->name('impacts.carbon.perkwh');
Route::get('impact/carbon/final', 'ImpactController@carbonFinal')->name('impacts.carbon.show.final');
Route::get('impact/resources', 'ImpactController@index')->name('impacts.resources.index');
Route::get('impact/resources/{resource}', 'ImpactController@resource')->name('impacts.resources.show');
Route::get('impact/resources/{resource}/final', 'ImpactController@resourceFinal')->name('impacts.resources.show.final');

Route::get('discover', 'InfoController@discover')->name('info.discover');

Route::get('/', function () {
    return view('welcome');
});
