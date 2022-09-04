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
Route::get('scenarios/{scenario}/production', 'ScenarioController@showProduction')->name('scenarios.show.production');
Route::get('scenarios/{scenario}', 'ScenarioController@show')->name('scenarios.show');
Route::get('energies', 'CategoryController@index')->name('categories.index');
Route::get('energies/{category}', 'CategoryController@show')->name('categories.show');
Route::get('energies/{category}/load-factor', 'CategoryController@showLoadFactor')->name('categories.show.load.factor');

Route::get('impact/total-production', 'ImpactController@showTotalProduction')->name('impacts.show.production.total');
Route::get('impact/carbon', 'ImpactController@carbon')->name('impacts.carbon.show');
Route::get('impact/resources', 'ImpactController@index')->name('impacts.resources.index');
Route::get('impact/resources/{resource}', 'ImpactController@resource')->name('impacts.resources.show');
Route::get('impact/resources/{resource}/final', 'ImpactController@resourceFinal')->name('impacts.resources.show.final');

Route::get('discover', 'InfoController@discover')->name('info.discover');

Route::get('/', function () {
    return view('welcome');
});
