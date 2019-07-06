<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rol;

class RolController extends Controller
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

            $rols = Rol::orderBy('id', 'desc')->paginate(5);
        } else {
            $rols = Rol::where($criterio, 'like', '%' . $buscar . '%')->orderBy('id', 'desc')->paginate(2);
        }
        return [
            'pagination' => [
                'total' => $rols->total(),
                'current_page' => $rols->currentPage(),
                'per_page' => $rols->perPage(),
                'last_page' => $rols->lastPage(),
                'from' => $rols->firstItem(),
                'to' => $rols->lastItem(),
            ],
            'rols'    => $rols
        ];
    }

    public function selectRol(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');
        $rols = rol::where('condicion', '=', '1')->select('id', 'nombre', 'descripcion')->orderBy('nombre', 'asc')->get();
        return ['rols' => $rols];
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

        $rol = new Rol();
        $rol->nombre          = $request->nombre;
        $rol->descripcion          = $request->descripcion;
        $rol->condicion         = '1';
        $rol->save();
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
        $rol = Rol::findOrFail($request->id);
        $rol->nombre          = $request->nombre;
        $rol->descripcion          = $request->descripcion;
        $rol->condicion         = '1';
        $rol->save();
    }

    public function desactivar(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');    
        $rol = Rol::findOrFail($request->id);
        $rol->condicion = '0';
        $rol->save();
    }   

    public function activar(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');
        $rol = rol::findOrFail($request->id);
        $rol->condicion = '1';
        $rol->save();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
}
