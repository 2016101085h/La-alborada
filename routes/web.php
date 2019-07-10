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
Route::get('/periodo/selectperiodo', 'PeriodoController@selectPeriodo');


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

Route::get('/rol', 'RolController@index');
Route::post('/rol/registrar', 'RolController@store');
Route::put('/rol/actualizar', 'RolController@update');
Route::put('/rol/desactivar', 'RolController@desactivar');
Route::put('/rol/activar', 'RolController@activar');
Route::get('/rol/selectrol', 'RolController@selectRol');

Route::get('/usuario', 'UsuarioController@index');
Route::post('/usuario/registrar', 'UsuarioController@store');
Route::put('/usuario/actualizar', 'UsuarioController@update');
Route::put('/usuario/desactivar', 'UsuarioController@desactivar');
Route::put('/usuario/activar', 'UsuarioController@activar');
Route::get('/usuario/selectusuario', 'UsuarioController@selectUsuario');



Route::get('/competencia', 'CompetenciaController@index');
Route::post('/competencia/registrar', 'CompetenciaController@store');
Route::put('/competencia/actualizar', 'CompetenciaController@update');
Route::put('/competencia/desactivar', 'CompetenciaController@desactivar');
Route::put('/competencia/activar', 'CompetenciaController@activar');
Route::get('/competencia/selectcompetencia', 'CompetenciaController@selectCompetencia');

Route::get('/nota', 'NotaController@index');
Route::post('/nota/registrar', 'NotaController@store');
Route::put('/nota/actualizar', 'NotaController@update');
Route::put('/nota/desactivar', 'NotaController@desactivar');
Route::put('/nota/activar', 'NotaController@activar');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
