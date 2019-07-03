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
    return view('contenido/contenido');
});

Route::get('/maestro', 'MaestroController@index');
Route::post('/maestro/registrar', 'MaestroController@store');
Route::put('/maestro/actualizar', 'MaestroController@update');
Route::put('/maestro/desactivar', 'MaestroController@desactivar');
Route::put('/maestro/activar', 'MaestroController@activar');
Route::get('/maestro', 'MaestroController@index');

Route::get('/grado', 'GradoController@index');
Route::post('/grado/registrar', 'GradoController@store');
Route::put('/grado/actualizar', 'GradoController@update');
Route::put('/grado/desactivar', 'GradoController@desactivar');
Route::put('/grado/activar', 'GradoController@activar');
Route::get('/grado', 'GradoController@index');
