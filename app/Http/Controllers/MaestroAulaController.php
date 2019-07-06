<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MaestroAula;

class MaestroAulaController extends Controller
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

            $maestro_aulas = MaestroAula::join('maestros', 'maestro_aulas.maestro_id', '=', 'maestros.id')->join('aulas','maestro_aulas.aula_id','=','aulas.id')
                ->join('cursos','maestro_aulas.curso_id','=','cursos.id')->select(
                    'maestro_aulas.id',
                    'maestro_aulas.maestro_id','maestros.nombre as nombre_maestro','maestros.apellido as apellido_maestro',
                    'maestro_aulas.aula_id','aulas.seccion','aulas.grado',
                    'maestro_aulas.curso_id','cursos.nombre as nombre_curso',                   
                    'maestro_aulas.condicion'
                )
                ->orderBy('maestro_aulas.id', 'desc')->paginate(5);
        } else {
            $maestro_aulas= MaestroAula::join('maestros', 'maestro_aulas.maestros_id', '=', 'maestros.id')->join('aulas','maestro_aulas.aula_id','=','aulas.id')
            ->join('cursos','maestro_aulas.curso_id','=','cursos.id')->select(
                'maestro_aulas.id',
                'maestro_aulas.maestro_id','maestros.nombre as nombre_maestro','maestros.apellido as apellido_maestro',
                'maestro_aulas.aula_id','aulas.seccion','aulas.grado',
                'maestro_aulas.curso_id','cursos.nombre as nombre_curso',                   
                'maestro_aulas.condicion'
            )
            ->where('maestro_aulas.' . $criterio, 'like', '%' . $buscar . '%')
                ->orderBy('maestro_aulas.id', 'desc')->paginate(2);
            // $alumnos = Alumno::where($criterio, 'like', '%' . $buscar . '%')->orderBy('id', 'desc')->paginate(2);
        }
        return [
            'pagination' => [
                'total' => $maestro_aulas->total(),
                'current_page' => $maestro_aulas->currentPage(),
                'per_page' => $maestro_aulas->perPage(),
                'last_page' => $maestro_aulas->lastPage(),
                'from' => $maestro_aulas->firstItem(),
                'to' => $maestro_aulas->lastItem(),
            ],
            'maestro_aulas'    => $maestro_aulas
        ];
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

        $maestro_aula = new MaestroAula();
        $maestro_aula->maestro_id          = $request->maestro_id;
        $maestro_aula->aula_id          = $request->aula_id;
        $maestro_aula->curso_id          = $request->curso_id;
        $maestro_aula->condicion         = '1';
        $maestro_aula->save();
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
        $grado_maestro = MaestroAula::findOrFail($request->id);
        $maestro_aula->maestro_id          = $request->maestro_id;
        $maestro_aula->aula_id          = $request->aula_id;
        $maestro_aula->curso_id          = $request->curso_id;
        $maestro_aula->condicion         = '1';
        $maestro_aula->save();
    }

    public function desactivar(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');    
        $maestro_aula = MaestroAula::findOrFail($request->id);
        $maestro_aula->condicion = '0';
        $maestro_aula->save();
    }

    public function activar(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');
        $maestro_aula = MaestroAula::findOrFail($request->id);
        $maestro_aula->condicion = '1';
        $maestro_aula->save();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
}
