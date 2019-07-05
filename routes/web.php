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
Route::get('/maestro/selectMaestro', 'MaestroController@selectMaestro');

Route::get('/grado', 'GradoController@index');
Route::post('/grado/registrar', 'GradoController@store');
Route::put('/grado/actualizar', 'GradoController@update');
Route::put('/grado/desactivar', 'GradoController@desactivar');
Route::put('/grado/activar', 'GradoController@activar');
Route::get('/grado/selectGrado', 'GradoController@selectGrado');

Route::get('/periodo', 'PeriodoController@index');
Route::post('/periodo/registrar', 'PeriodoController@store');
Route::put('/periodo/actualizar', 'PeriodoController@update');
Route::put('/periodo/desactivar', 'PeriodoController@desactivar');
Route::put('/periodo/activar', 'PeriodoController@activar');


Route::get('/alumno', 'AlumnoController@index');
Route::post('/alumno/registrar', 'AlumnoController@store');
Route::put('/alumno/actualizar', 'AlumnoController@update');
Route::put('/alumno/desactivar', 'AlumnoController@desactivar');
Route::put('/alumno/activar', 'AlumnoController@activar');
Route::get('/alumno/selectAlumno', 'AlumnoController@selectAlumno');


Route::get('/asignatura', 'AsignaturaController@index');
Route::post('/asignatura/registrar', 'AsignaturaController@store');
Route::put('/asignatura/actualizar', 'AsignaturaController@update');
Route::put('/asignatura/desactivar', 'AsignaturaController@desactivar');
Route::put('/asignatura/activar', 'AsignaturaController@activar');
Route::get('/asignatura/selectAsignatura', 'AsignaturaController@selectAsignatura');

Route::get('/alumnoasignatura', 'AlumnoAsignaturaController@index');
Route::post('/alumnoasignatura/registrar', 'AlumnoAsignaturaController@store');
Route::put('/alumnoasignatura/actualizar', 'AlumnoAsignaturaController@update');
Route::put('/alumnoasignatura/desactivar', 'AlumnoAsignaturaController@desactivar');
Route::put('/alumnoasignatura/activar', 'AlumnoAsignaturaController@activar');

Route::get('/maestroasignatura', 'MaestroAsignaturaController@index');
Route::post('/maestroasignatura/registrar', 'MaestroAsignaturaController@store');
Route::put('/maestroasignatura/actualizar', 'MaestroAsignaturaController@update');
Route::put('/maestroasignatura/desactivar', 'MaestroAsignaturaController@desactivar');
Route::put('/maestroasignatura/activar', 'MaestroAsignaturaController@activar');

Route::get('/gradomaestro', 'GradoMaestroController@index');
Route::post('/gradomaestro/registrar', 'GradoMaestroController@store');
Route::put('/gradomaestro/actualizar', 'GradoMaestroController@update');
Route::put('/gradomaestro/desactivar', 'GradoMaestroController@desactivar');
Route::put('/gradomaestro/activar', 'GradoMaestroController@activar');

