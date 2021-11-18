<?php

use App\Http\Controllers\TestController;
use App\Http\Controllers\VariablesMetereologicasController;
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

Route::get('/', function () {
    return view('charts.dashboard');
})->name('inicio')->middleware('auth');

Route::resource('variables', VariablesMetereologicasController::class)->middleware('auth');

Route::get('graficas/direccion', function() {
    return view('charts.direccion');
})->name('direccion')->middleware('auth');

Route::get('graficas/humedad', function() {
    return view('charts.humedad');
})->name('humedad')->middleware('auth');

Route::get('graficas/lluvia', function() {
    return view('charts.lluvia');
})->name('lluvia')->middleware('auth');

Route::get('graficas/luz', function() {
    return view('charts.luz');
})->name('luz')->middleware('auth');

Route::get('graficas/temperatura', function() {
    return view('charts.temperatura');
})->name('temperatura')->middleware('auth');

Route::get('graficas/velocidad', function() {
    return view('charts.velocidad');
})->name('velocidad')->middleware('auth');

Route::get('graficas/presion', function() {
    return view('charts.presion');
})->name('presion')->middleware('auth');


Route::get('ultimo_registro', [VariablesMetereologicasController::class, 'obtenerUltimo']);

Auth::routes();