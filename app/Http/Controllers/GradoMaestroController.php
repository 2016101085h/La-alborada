<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GradoMaestro;
use App\Maestro;
use App\Grado;

class GradoMaestroController extends Controller
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

            $grado_maestros = GradoMaestro::join('grados', 'grado_maestros.grado_id', '=', 'grados.id')->join('maestros','grado_maestros.maestro_id','=','maestros.id')
                ->select(
                    'grado_maestros.id',
                    'grado_maestros.grado_id','grados.grado','grados.seccion','grados.turno',
                    'grado_maestros.maestro_id','maestros.nombre','maestros.apellido',                   
                    'grado_maestros.condicion'
                )
                ->orderBy('grado_maestros.id', 'desc')->paginate(5);
        } else {
            $grado_maestros= GradoMaestro::join('grados', 'grado_maestros.grado_id', '=', 'grados.id')->join('maestros','grado_maestros.maestro_id','=','maestros.id')
            ->select(
                'grado_maestros.id',
                'grado_maestros.grado_id','grados.grado','grados.seccion','grados.turno',
                'grado_maestros.maestro_id','maestros.nombre','maestros.apellido',                   
                'grado_maestros.condicion'
            )->where('grado_maestros.' . $criterio, 'like', '%' . $buscar . '%')
                ->orderBy('grado_maestros.id', 'desc')->paginate(2);
            // $alumnos = Alumno::where($criterio, 'like', '%' . $buscar . '%')->orderBy('id', 'desc')->paginate(2);
        }
        return [
            'pagination' => [
                'total' => $grado_maestros->total(),
                'current_page' => $grado_maestros->currentPage(),
                'per_page' => $grado_maestros->perPage(),
                'last_page' => $grado_maestros->lastPage(),
                'from' => $grado_maestros->firstItem(),
                'to' => $grado_maestros->lastItem(),
            ],
            'grado_maestros'    => $grado_maestros
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

        $grado_maestro = new GradoMaestro();
        $grado_maestro->grado_id          = $request->grado_id;
        $grado_maestro->maestro_id          = $request->maestro_id;
        $grado_maestro->condicion         = '1';
        $grado_maestro->save();
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
        $grado_maestro = GradoMaestro::findOrFail($request->id);
        $grado_maestro->grado_id          = $request->grado_id;
        $grado_maestro->maestro_id          = $request->maestro_id;
        $grado_maestro->condicion         = '1';
        $grado_maestro->save();
    }

    public function desactivar(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');    
        $grado_maestro = GradoMaestro::findOrFail($request->id);
        $grado_maestro->condicion = '0';
        $grado_maestro->save();
    }

    public function activar(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');
        $grado_maestro = GradoMaestro::findOrFail($request->id);
        $grado_maestro->condicion = '1';
        $grado_maestro->save();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
}
