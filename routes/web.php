<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImpactController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\ScenarioController;
use Illuminate\Support\Facades\Route;

Route::get('scenarios', [ScenarioController::class, 'index'])->name('scenarios.index');
Route::get('scenarios/{scenario}/capacity', [ScenarioController::class, 'showCapacity'])->name('scenarios.show.capacity');
Route::get('scenarios/{scenario}/energy', [ScenarioController::class, 'showEnergy'])->name('scenarios.show.energy');
Route::get('scenarios/{scenario}', [ScenarioController::class, 'show'])->name('scenarios.show');

Route::get('energies', [CategoryController::class, 'index'])->name('categories.index');
Route::get('energies/{category}/production', [CategoryController::class, 'showProduction'])->name('categories.show.production');
Route::get('energies/{category}/capacity', [CategoryController::class, 'showCapacity'])->name('categories.show.capacity');
Route::get('energies/{category}/load-factor', [CategoryController::class, 'showLoadFactor'])->name('categories.show.load.factor');

Route::get('impact/production', [ImpactController::class, 'production'])->name('impacts.production.show');
Route::get('impact/production/final', [ImpactController::class, 'productionFinal'])->name('impacts.production.show.final');
Route::get('impact/consumption/{resource}/final', [ImpactController::class, 'productionFinal'])->name('impacts.consumption.show.final');
Route::get('impact/carbon', [ImpactController::class, 'carbon'])->name('impacts.carbon.show');
Route::get('impact/carbon/per-kwh', [ImpactController::class, 'carbonPerkWh'])->name('impacts.carbon.perkwh');
Route::get('impact/carbon/final', [ImpactController::class, 'carbonFinal'])->name('impacts.carbon.show.final');
Route::get('impact/resources', [ImpactController::class, 'index'])->name('impacts.resources.index');
Route::get('impact/resources/{resource}', [ImpactController::class, 'resource'])->name('impacts.resources.show');
Route::get('impact/resources/{resource}/final', [ImpactController::class, 'resourceFinal'])->name('impacts.resources.show.final');

Route::get('discover', [InfoController::class, 'discover'])->name('info.discover');

Route::get('/', function () {
    return view('welcome');
});
