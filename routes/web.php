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
Route::get('/maestro/selectmaestro', 'MaestroController@selectMaestro');

Route::get('/aula', 'AulaController@index');
Route::post('/aula/registrar', 'AulaController@store');
Route::put('/aula/actualizar', 'AulaController@update');
Route::put('/aula/desactivar', 'AulaController@desactivar');
Route::put('/aula/activar', 'AulaController@activar');
Route::get('/aula/selectaula', 'AulaController@selectAula');

Route::get('/maestroaula', 'MaestroAulaController@index');
Route::post('/maestroaula/registrar', 'MaestroAulaController@store');
Route::put('/maestroaula/actualizar', 'MaestroAulaController@update');
Route::put('/maestroaula/desactivar', 'MaestroAulaController@desactivar');
Route::put('/maestroaula/activar', 'MaestroAulaController@activar');


Route::get('/periodo', 'PeriodoController@index');
Route::post('/periodo/registrar', 'PeriodoController@store');
Route::put('/periodo/actualizar', 'PeriodoController@update');
Route::put('/periodo/desactivar', 'PeriodoController@desactivar');
Route::put('/periodo/activar', 'PeriodoController@activar');


Route::get('/estudiante', 'EstudianteController@index');
Route::post('/estudiante/registrar', 'EstudianteController@store');
Route::put('/estudiante/actualizar', 'EstudianteController@update');
Route::put('/estudiante/desactivar', 'EstudianteController@desactivar');
Route::put('/estudiante/activar', 'EstudianteController@activar');
Route::get('/estudiante/selectestudiante', 'EstudianteController@selectEstudiante');


Route::get('/curso', 'CursoController@index');
Route::post('/curso/registrar', 'CursoController@store');
Route::put('/curso/actualizar', 'CursoController@update');
Route::put('/curso/desactivar', 'CursoController@desactivar');
Route::put('/curso/activar', 'CursoController@activar');
Route::get('/curso/selectcurso', 'CursoController@selectCurso');

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

