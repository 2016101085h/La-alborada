<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AlumnoAsignatura;

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

            $alumnoasignaturas = AlumnoAsignatura::join('alumnos', 'alumno_asignaturas.alumno_id', '=', 'alumnos.id')->join('asignaturas','alumno_asignaturas.asignatura_id','=','asignaturas.id')
                ->select(
                    'alumno_asignaturas.id',
                    'alumno_asignaturas.alumno_id','alumno_asignaturas.asignatura_id',
                    'alumnos.nombre','alumnos.apellido',
                    'asignaturas.nombre'
                    
                )
                ->orderBy('alumno_asignaturas.id', 'desc')->paginate(5);
        } else {
            $alumnoasignaturas = AlumnoAsignatura::join('alumnos', 'alumno_asignaturas.alumno_id', '=', 'alumnos.id')->join('asignaturas', 'alumno_asignaturas.asignatura_id', '=', 'asignaturas.id')
                ->select(
                    'alumno_asignaturas.id',
                    'alumno_asignaturas.alumno_id',
                    'alumno_asignaturas.asignatura_id',
                    'alumnos.nombre',
                    'alumnos.apellido',
                    'asignaturas.nombre'
                    
                )->where('alumno_asignaturas.' . $criterio, 'like', '%' . $buscar . '%')
                ->orderBy('alumno_asignaturas.id', 'desc')->paginate(2);
            // $alumnos = Alumno::where($criterio, 'like', '%' . $buscar . '%')->orderBy('id', 'desc')->paginate(2);
        }
        return [
            'pagination' => [
                'total' => $alumnoasignaturas->total(),
                'current_page' => $alumnoasignaturas->currentPage(),
                'per_page' => $alumnoasignaturas->perPage(),
                'last_page' => $alumnoasignaturas->lastPage(),
                'from' => $alumnoasignaturas->firstItem(),
                'to' => $alumnoasignaturas->lastItem(),
            ],
            'alumnocategorias'    => $alumnoasignaturas
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
