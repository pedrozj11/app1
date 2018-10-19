<?php

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
    return view('inicio');
});

Route::get('/juego', function () {
    return view('juego', ['respuestas' => '']);
});

Route::post('/juego','JuegoController@preguntar');

Route::get('/fin-juego/{id}', function ($id) {
    return view('finJuego', ['id' => $id]);
});




Route::get('/fin-juego-malo', function () {
    return view('finJuegoMalo');
});