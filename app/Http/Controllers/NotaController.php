<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nota;

class NotaController extends Controller
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

            $notas = Nota::join('competencias', 'notas.competencia_id', '=', 'competencias.id')->join('estudiantes', 'notas.estudiante_id', '=', 'estudiantes.id')->
            join('cursos', 'notas.curso_id', '=', 'cursos.id')->join('periodos', 'notas.periodo_id', '=', 'periodos.id')->select(
                    'notas.id',
                    'competencias.nombre as nombre_competencia','estudiantes.nombre as nombre_estudiante','estudiantes.apellido as apellido_estudiante',
                    'cursos.nombre as nombre_curso','periodos.nombre as nombre_periodo',
                    'notas.calificacion','notas.condicion'
                   
                )
                ->orderBy('notas.id', 'desc')->paginate(5);
        } else {
            $notas = Nota::join('competencias', 'notas.competencia_id', '=', 'competencias.id')->join('estudiantes', 'notas.estudiante_id', '=', 'estudiantes.id')->join('cursos', 'notas.curso_id', '=', 'cursos.id')->join('periodos', 'notas.periodo_id', '=', 'periodos.id')->select(
                    'notas.id',
                    'competencias.nombre as nombre_competencia',
                    'estudiantes.nombre as nombre_estudiante',
                    'estudiantes.apellido as apellido_estudiante',
                    'cursos.nombre as nombre_curso',
                    'periodos.nombre as nombre_periodo',
                    'notas.calificacion',
                    'notas.condicion'

                )
                ->where('notas.' . $criterio, 'like', '%' . $buscar . '%')
                ->orderBy('notas.id', 'desc')->paginate(2);
            // $alumnos = Alumno::where($criterio, 'like', '%' . $buscar . '%')->orderBy('id', 'desc')->paginate(2);
        }
        return [
            'pagination' => [
                'total' => $notas->total(),
                'current_page' => $notas->currentPage(),
                'per_page' => $notas->perPage(),
                'last_page' => $notas->lastPage(),
                'from' => $notas->firstItem(),
                'to' => $notas->lastItem(),
            ],
            'notas'    => $notas
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

        $nota = new Nota();
        $nota->competencia_id          = $request->competencia_id;
        $nota->estudiante_id          = $request->estudiante_id;
        $nota->curso_id          = $request->curso_id;
        $nota->periodo_id          = $request->periodo_id;
        $nota->calificacion          = $request->calificacion;
        $nota->condicion         = '1';
        $nota->save();
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
        $nota = Nota::findOrFail($request->id);
        $nota->competencia_id          = $request->competencia_id;
        $nota->estudiante_id          = $request->estudiante_id;
        $nota->curso_id          = $request->curso_id;
        $nota->periodo_id          = $request->periodo_id;
        $nota->calificacion          = $request->calificacion;
        $nota->condicion         = '1';
        $nota->save();
    }

    public function desactivar(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');    
        $nota = Nota::findOrFail($request->id);
        $nota->condicion = '0';
        $nota->save();
    }

    public function activar(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');
        $nota = Nota::findOrFail($request->id);
        $nota->condicion = '1';
        $nota->save();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
}
