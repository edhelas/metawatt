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
Route::get('categories', 'CategoryController@index')->name('categories.index');
Route::get('categories/{category}', 'CategoryController@show')->name('categories.show');

Route::get('impact/carbon', 'ImpactController@carbon')->name('impacts.carbon.show');
Route::get('impact/resources', 'ImpactController@index')->name('impacts.resources.index');
Route::get('impact/resources/{resource}', 'ImpactController@resources')->name('impacts.resources.show');

Route::get('/', function () {
    return view('welcome');
});
