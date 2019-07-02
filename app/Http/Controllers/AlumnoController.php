<?php

namespace App\Http\Controllers;

use App\Alumno;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alumnos = Alumno::all();

        return ['alumnos' => $alumnos];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $alumno = new Alumno;

        $alumno->grado_id = $request->grado_id;
        $alumno->nombre = $request->nombre;
        $alumno->apellido = $request->apellido;
        $alumno->sexo = $request->sexo;
        $alumno->fech_nacimiento = $request->fech_nacimiento;
        $alumno->direccion = $request->direccion;
        $alumno->condicion = '1';
        $alumno->save();

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alumno $alumno)
    {
        $alumno = Alumno::findOrFail($request->id);
        $alumno->grado_id = $request->grado_id;
        $alumno->nombre = $request->nombre;
        $alumno->apellido = $request->apellido;
        $alumno->sexo = $request->sexo;
        $alumno->fech_nacimiento = $request->fech_nacimiento;
        $alumno->direccion = $request->direccion;
        $alumno->condicion = '1';
        $alumno->save();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function activar(Request $request)
    {
        $alumno = Alumno::findOrFail($request->id);
        $alumno->condicion = '1';
        
    }

    public function desactivar(Request $request)
    {
        $alumno = Alumno::findOrFail($request->id);
        $alumno->condicion = '0';
        
    }
}
