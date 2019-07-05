<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AlumnoAsignatura;
use App\Alumno;
use App\Asignatura;

class AlumnoAsignaturaController extends Controller
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

            $alumno_asignaturas = AlumnoAsignatura::join('alumnos', 'alumno_asignaturas.alumno_id', '=', 'alumnos.id')->join('asignaturas','alumno_asignaturas.asignatura_id','=','asignaturas.id')
                ->select(
                    'alumno_asignaturas.id',
                    'alumno_asignaturas.alumno_id',
                    'alumnos.nombre as nombre_alumno','alumnos.apellido as apellido_alumno',
                    'alumno_asignaturas.asignatura_id',
                    'asignaturas.nombre as nombre_asignatura',
                    'alumno_asignaturas.condicion'
                    
                )
                ->orderBy('alumno_asignaturas.id', 'desc')->paginate(5);
        } else {
            $alumno_asignaturas = AlumnoAsignatura::join('alumnos', 'alumno_asignaturas.alumno_id', '=', 'alumnos.id')->join('asignaturas','alumno_asignaturas.asignatura_id','=','asignaturas.id')
            ->select(
                'alumno_asignaturas.id',
                'alumno_asignaturas.alumno_id',
                'alumnos.nombre as nombre_alumno','alumnos.apellido as apellido_alumno',
                'alumno_asignaturas.asignatura_id',
                'asignaturas.nombre as nombre_asignatura',
                'alumno_asignaturas.condicion'
                
            )->where('alumno_asignaturas.' . $criterio, 'like', '%' . $buscar . '%')
                ->orderBy('alumno_asignaturas.id', 'desc')->paginate(2);
            // $alumnos = Alumno::where($criterio, 'like', '%' . $buscar . '%')->orderBy('id', 'desc')->paginate(2);
        }
        return [
            'pagination' => [
                'total' => $alumno_asignaturas->total(),
                'current_page' => $alumno_asignaturas->currentPage(),
                'per_page' => $alumno_asignaturas->perPage(),
                'last_page' => $alumno_asignaturas->lastPage(),
                'from' => $alumno_asignaturas->firstItem(),
                'to' => $alumno_asignaturas->lastItem(),
            ],
            'alumno_asignaturas'    => $alumno_asignaturas
        ];
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // if(!$request->ajax()) return redirect('/');

        $alumnoasignatura = new AlumnoAsignatura();
        $alumnoasignatura->alumno_id          = $request->alumno_id;
        $alumnoasignatura->asignatura_id          = $request->asignatura_id;
        $alumnoasignatura->condicion         = '1';
        $alumnoasignatura->save();
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
        $alumnoasignatura = AlumnoAsignatura::findOrFail($request->id);
        $alumnoasignatura->alumno_id          = $request->alumno_id;
        $alumnoasignatura->asignatura_id          = $request->asignatura_id;
        $alumnoasignatura->condicion         = '1';
        $alumnoasignatura->save();
    }

    public function desactivar(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');    
        $alumnoasignatura = AlumnoAsignatura::findOrFail($request->id);
        $alumnoasignatura->condicion = '0';
        $alumnoasignatura->save();
    }

    public function activar(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');
        $alumnoasignatura = AlumnoAsignatura::findOrFail($request->id);
        $alumnoasignatura->condicion = '1';
        $alumnoasignatura->save();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
}
