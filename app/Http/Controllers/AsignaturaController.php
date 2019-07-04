<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asignatura;

class AsignaturaController extends Controller
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

            $asignaturas = Asignatura::join('maestros', 'asignaturas.maestro_id', '=', 'maestros.id')->join('grados','asignaturas.grado_id','=','grados.id')
                ->select(
                    'asignaturas.id',
                    'asignaturas.nombre',
                    'asignaturas.temario',
                    'asignaturas.maestro_id as maestro_asignatura','maestros.nombre as nombre_maestro','maestros.apellido as apellido_maestro',  
                    'asignaturas.grado_id as  grado_asignatura','grados.grado as grado','grados.seccion as seccion_grado',                
                    'asignaturas.condicion'
                )
                ->orderBy('asignaturas.id', 'desc')->paginate(5);
        } else {

            $asignaturas = Asignatura::join('maestros', 'asignaturas.maestro_id', '=', 'maestros.id')->join('grados', 'asignaturas.grado_id', '=', 'grados.id')
                ->select(
                    'asignaturas.id',
                    'asignaturas.nombre',
                    'asignaturas.temario',
                    'asignaturas.maestro_id ',
                    'maestros.nombre as nombre_maestro',
                    'maestros.apellido as apellido_maestro',
                    'asignaturas.grado_id ',
                    'grados.grado as grado',
                    'grados.seccion as seccion_grado',
                    'asignaturas.condicion'
                )->where('asignaturas.' . $criterio, 'like', '%' . $buscar . '%')
                ->orderBy('asignaturas.id', 'desc')->paginate(2);
            // $alumnos = Alumno::where($criterio, 'like', '%' . $buscar . '%')->orderBy('id', 'desc')->paginate(2);
        }
        return [
            'pagination' => [
                'total' => $asignaturas->total(),
                'current_page' => $asignaturas->currentPage(),
                'per_page' => $asignaturas->perPage(),
                'last_page' => $asignaturas->lastPage(),
                'from' => $asignaturas->firstItem(),
                'to' => $asignaturas->lastItem(),
            ],
            'asignaturas'    => $asignaturas
        ];
    }
    public function selectAsignatura(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');
        $asignaturas = Asignatura::where('condicion', '=', '1')->select('id', 'nombre')->orderBy('nombre', 'asc')->get();
        return ['asignaturas' => $asignaturas];
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

        $asignatura = new Asignatura();
        $asignatura->nombre          = $request->nombre;
        $asignatura->temario        = $request->temario;
        $asignatura->maestro_id        = $request->maestro_id;
        $asignatura->grado_id              = $request->grado_id;
        $asignatura->condicion         = '1';
        $asignatura->save();
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
        $asignatura = Asignatura::findOrFail($request->id);
        $asignatura->nombre          = $request->nombre;
        $asignatura->temario        = $request->temario;
        $asignatura->maestro_id        = $request->maestro_id;
        $asignatura->grado_id              = $request->grado_id;
        $asignatura->condicion         = '1';
        $asignatura->save();
    }

    public function desactivar(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');    
        $asignatura = Asignatura::findOrFail($request->id);
        $asignatura->condicion = '0';
        $asignatura->save();
    }

    public function activar(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');
        $asignatura = Asignatura::findOrFail($request->id);
        $asignatura->condicion = '1';
        $asignatura->save();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
}
