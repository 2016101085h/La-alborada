<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MaestroAsignatura;
use App\Maestro;

class MaestroAsignaturaController extends Controller
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

            $maestro_asignaturas = MaestroAsignatura::join('maestros', 'maestro_asignaturas.maestro_id', '=', 'maestros.id')->join('asignaturas','maestro_asignaturas.asignatura_id','=','asignaturas.id')
                ->select(
                    'maestro_asignaturas.id',
                    'maestro_asignaturas.maestro_id',
                    'maestro_asignaturas.asignatura_id',
                    'maestros.nombre','maestros.apellido','asignaturas.nombre as nombre_asignatura',                    
                    'maestro_asignaturas.condicion'
                )
                ->orderBy('maestro_asignaturas.id', 'desc')->paginate(5);
        } else {
            $maestro_asignaturas= MaestroAsignatura::join('maestros', 'maestro_asignaturas.maestro_id', '=', 'maestros.id')->join('asignaturas', 'maestro_asignaturas.asignatura_id', '=', 'asignaturas.id')
                ->select(
                    'maestro_asignaturas.id',
                    'maestro_asignaturas.maestro_id',
                    'maestro_asignaturas.asignatura_id',
                    'maestros.nombre',
                    'maestros.apellido',
                    'asignaturas.nombre as nombre_asignatura',
                    'maestro_asignaturas.condicion'
                )->where('maestro_asignaturas.' . $criterio, 'like', '%' . $buscar . '%')
                ->orderBy('maestro_asignaturas.id', 'desc')->paginate(2);
            // $alumnos = Alumno::where($criterio, 'like', '%' . $buscar . '%')->orderBy('id', 'desc')->paginate(2);
        }
        return [
            'pagination' => [
                'total' => $maestro_asignaturas->total(),
                'current_page' => $maestro_asignaturas->currentPage(),
                'per_page' => $maestro_asignaturas->perPage(),
                'last_page' => $maestro_asignaturas->lastPage(),
                'from' => $maestro_asignaturas->firstItem(),
                'to' => $maestro_asignaturas->lastItem(),
            ],
            'maestro_asignaturas'    => $maestro_asignaturas
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

        $maestro_asignatura = new MaestroAsignatura();
        $maestro_asignatura->maestro_id          = $request->maestro_id;
        $maestro_asignatura->asignatura_id          = $request->asignatura_id;
        $maestro_asignatura->condicion         = '1';
        $maestro_asignatura->save();
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
        $maestro_asignatura = MaestroAsignatura::findOrFail($request->id);
        $maestro_asignatura->maestro_id          = $request->maestro_id;
        $maestro_asignatura->asignatura_id          = $request->asignatura_id;
        $maestro_asignatura->condicion         = '1';
        $maestro_asignatura->save();
    }

    public function desactivar(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');    
        $maestro_asignatura = MaestroAsignatura::findOrFail($request->id);
        $maestro_asignatura->condicion = '0';
        $maestro_asignatura->save();
    }

    public function activar(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');
        $maestro_asignatura = MaestroAsignatura::findOrFail($request->id);
        $maestro_asignatura->condicion = '1';
        $maestro_asignatura->save();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
}
