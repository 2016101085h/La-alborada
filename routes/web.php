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

Route::get('/alumno', 'AlumnoController@index');
Route::post('/alumno/registrar', 'AlumnoController@store');
Route::put('/alumno/actualizar', 'AlumnoController@update');
Route::put('/alumno/desactivar', 'AlumnoController@desactivar');
Route::put('/alumno/activar', 'AlumnoController@activar');