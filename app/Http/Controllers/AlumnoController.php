<?php

namespace App\Http\Controllers;

use App\{Alumno, Grado};
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
        $alumnos = Alumno::join('grados', 'alumnos.grado_id', '=', 'grados.id')->select('alumnos.id', 'alumnos.grado_id', 'alumnos.nombre', 'alumnos.apellido','alumnos.sexo', 'alumnos.fech_nacimiento', 'alumnos.direccion', 'alumnos.condicion', 'grados.seccion')->orderBy('alumnos.id', 'desc')->get();

        $grados = Grado::all();   

        return [
            'alumnos' => $alumnos,
            'grados' => $grados
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
    public function update(Request $request)
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
        $alumno->save();
    }

    public function desactivar(Request $request)
    {
        $alumno = Alumno::findOrFail($request->id);
        $alumno->condicion = '0';
        $alumno->save();
        
    }
}
