<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Maestro;

class MaestroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       // if (!$request->ajax()) return redirect('/');
        $maestros = Maestro::all();
        return $maestros;
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
        $maestro=new Maestro();
        $maestro->m_nombre = $request->m_nombre;
        $maestro->m_apellido = $request->m_apellido;
        $maestro->m_fech_nac = $request->m_fech_nac;
        $maestro->sexo = $request->sexo;
        $maestro->grado_intruccion = $request->grado_intruccion;
        $maestro->m_direccion = $request->m_direccion;
        $maestro->num_celular = $request->num_celular;
        $maestro->condicion = '1';
        $maestro->save();


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
        $maestro = fMaestro::findOrFail($request->id_maestro);
        $maestro->m_nombre = $request->m_nombre;
        $maestro->m_apellido = $request->m_apellido;
        $maestro->m_fech_nac = $request->m_fech_nac;
        $maestro->sexo = $request->sexo;
        $maestro->grado_intruccion = $request->grado_intruccion;
        $maestro->m_direccion = $request->m_direccion;
        $maestro->num_celular = $request->num_celular;
        $maestro->condicion = '1';
        $maestro->save();
    }

    public function desactivar(Request $request){
        $maestro = fMaestro::findOrFail($request->id_maestro);
        $maestro->condicion = '0';
        $maestro->save();
    }

    public function activar(Request $request){
        $maestro = fMaestro::findOrFail($request->id_maestro);
        $maestro->condicion = '1';
        $maestro->save();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
}
