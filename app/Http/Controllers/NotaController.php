<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Nota, Periodo, Aula, Estudiante, Competencia, Curso};

class NotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Select Aula
        $aulas = Aula::all();
        //Select Cursos
        $cursos = Curso::all();
        //Select Alumno
        $periodos = Periodo::all();

        $notas = Nota::join('competencias', 'notas.competencia_id', '=', 'competencias.id')->
        join('estudiantes', 'notas.estudiante_id', '=', 'estudiantes.id')->
        join('cursos', 'notas.curso_id', '=', 'cursos.id')->
        join('periodos', 'notas.periodo_id', '=', 'periodos.id')->
        select('competencias.nombre as competencia', 'estudiantes.nombre', 'estudiantes.apellido', 'cursos.nombre as curso', 'periodos.nombre as periodo', 'notas.calificacion', 'notas.condicion')
        ->orderBy('notas.estudiante_id','asc')->get();
        return [
            // 'pagination' => [
            //     'total' => $notas->total(),
            //     'current_page' => $notas->currentPage(),
            //     'per_page' => $notas->perPage(),
            //     'last_page' => $notas->lastPage(),
            //     'from' => $notas->firstItem(),
            //     'to' => $notas->lastItem(),
            // ],
            'notas'    => $notas,
            'periodos' => $periodos,
            'cursos' => $cursos,
            'aulas' => $aulas
        ];
    }
    public function listarPdf(Request $request )
    {
        
        //Select Alumno
        

        $notas = Nota::join('competencias', 'notas.competencia_id', '=', 'competencias.id')->
        join('estudiantes', 'notas.estudiante_id', '=', 'estudiantes.id')->
        join('cursos', 'notas.curso_id', '=', 'cursos.id')->join('periodos', 'notas.periodo_id', '=', 'periodos.id')->
        select('notas.id','competencias.nombre as competencia', 'estudiantes.nombre', 'estudiantes.apellido', 'cursos.nombre as curso',
         'periodos.nombre as periodo', 'notas.calificacion')->get();
          $cont = Nota::count();
          $pdf = \PDF::loadView('pdf.notaspdf', ['notas' => $notas, 'cont' => $cont]);
          return $pdf->download('notas.pdf');
        //  return['notas'=>$notas];
    }

    /**returm $sdqw, -$wfwefwwrv
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function est_comp(Request $request)
    {
        $select_aula = $request->aula_id;
        $select_curso = $request->curso_id;

        $estudiantes = Estudiante::where('aula_id', '=', $select_aula)->select('id', 'nombre', 'apellido')->orderBy('apellido', 'asc')->get();
        //Select Competencias
        $competencias = Competencia::where('competencias.curso_id', '=', $select_curso)->get();

        return [
            'competencias' => $competencias,
            'estudiantes' => $estudiantes
        ];
    }

    public function store(Request $request)
    {

        // if(!$request->ajax()) return redirect('/');
        $data = $request->data;
        for ($i = 0; $i < sizeof($data); $i++) {
            foreach ($data as $d) {
                $nota = new Nota();
                $nota->competencia_id    = $request->competencias[$i]['id'];
                $nota->estudiante_id          = $d['id'];
                $nota->curso_id          = $request->curso_id;
                $nota->periodo_id          = $request->periodo_id;
                $nota->calificacion          = $d['nota']['nota' . $i];
                $nota->condicion         = '1';
                $nota->save();
            }
        }
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

    public function estudiantes(Request $request)
    {
        $aula_id = $request->aula_id;
        $estudiantes = Estudiante::where('aula_id', '=', $aula_id)->get();

        return ['estudiantes' => $estudiantes];
    }
}
