<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Competencia;
class CompetenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');
        // $maestros = Maestro::all();
        // return $maestros;
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        if ($buscar == '') {

            $competencias = Competencia::join('cursos', 'competencias.curso_id', '=', 'cursos.id')
                ->select(
                    'competencias.id',
                    'competencias.curso_id','cursos.nombre as nombre_curso',      
                    'competencias.nombre as nombre_competencia',
                    'competencias.condicion'
                )
                ->orderBy('competencias.id', 'desc')->paginate(5);
        } else {
            $competencias = Competencia::join('cursos', 'competencias.curso_id', '=', 'cursos.id')
                ->select(
                    'competencias.id',
                    'competencias.curso_id',
                    'cursos.nombre as nombre_curso',
                    'competencias.nombre as nombre_competencia',
                    'competencias.condicion'
                )
                ->where('competencias.' . $criterio, 'like', '%' . $buscar . '%')->orderBy('competencias.id', 'desc')->paginate(2);
            // $alumnos = Alumno::where($criterio, 'like', '%' . $buscar . '%')->orderBy('id', 'desc')->paginate(2);
        }
        return [
            'pagination' => [
                'total' => $competencias->total(),
                'current_page' => $competencias->currentPage(),
                'per_page' => $competencias->perPage(),
                'last_page' => $competencias->lastPage(),
                'from' => $competencias->firstItem(),
                'to' => $competencias->lastItem(),
            ],
            'competencias'    => $competencias
        ];
    }

    public function selectCompetencia(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');
        $competencias = Competencia::where('condicion', '=', '1')->select('id', 'nombre')->orderBy('nombre', 'asc')->get();
        return ['competencias' => $competencias];
    }

    /**returm $sdqw, -$wfwefwwrv    
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // if(!$request->ajax()) return redirect('/');

        $competencia = new Competencia();
        $competencia->curso_id          = $request->curso_id;
        $competencia->nombre          = $request->nombre;
        $competencia->condicion         = '1';
        $competencia->save();
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');
        $competencia = Competencia::findOrFail($request->id);
        $competencia->curso_id          = $request->curso_id;
        $competencia->nombre          = $request->nombre;
        $competencia->condicion         = '1';
        $competencia->save();
    }

    public function desactivar(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');    
        $competencia = Competencia::findOrFail($request->id);
        $competencia->condicion = '0';
        $competencia->save();
    }

    public function activar(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');
        $competencia = Competencia::findOrFail($request->id);
        $competencia->condicion = '1';
        $competencia->save();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
}
