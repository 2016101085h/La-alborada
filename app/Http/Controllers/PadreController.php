<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Padre;

class PadreController extends Controller
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

            $padres = Padre::join('estudiantes', 'padres.estudiante_id', '=', 'estudiantes.id')->join('notas','padres.nota_id','=','notas.id')
                ->select(
                    'padres.id',
                    'padres.estudiante_id',
                    'estudiantes.nombre',
                    'estudiantes.apellido',
                    'estudiantes.dni',
                    'notas.calificacion',
                    'padres.fech_nacimiento',
                    'padres.dni',
                    'padres.sexo',
                    'padres.direccion',
                    'padres.condicion'
                )
                ->orderBy('padres.id', 'desc')->paginate(5);
        } else {
            $padres = Padre::join('aulas', 'padres.aula_id', '=', 'aulas.id')
                ->select(
                    'padres.id',
                    'padres.aula_id',
                    'aulas.grado',
                    'aulas.seccion',
                    'padres.nombre',
                    'padres.apellido',
                    'padres.fech_nacimiento',
                    'padres.dni',
                    'padres.sexo',
                    'padres.direccion',
                    'padres.condicion'
                )
                ->where('padres.' . $criterio, 'like', '%' . $buscar . '%')
                ->orderBy('padres.id', 'desc')->paginate(2);
            // $padres = Padre::where($criterio, 'like', '%' . $buscar . '%')->orderBy('id', 'desc')->paginate(2);
        }
        return [
            'pagination' => [
                'total' => $padres->total(),
                'current_page' => $padres->currentPage(),
                'per_page' => $padres->perPage(),
                'last_page' => $padres->lastPage(),
                'from' => $padres->firstItem(),
                'to' => $padres->lastItem(),
            ],
            'padres'    => $padres
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

        $Padre = new Estudiante();
        $estudiante->aula_id          = $request->aula_id;
        $estudiante->nombre          = $request->nombre;
        $estudiante->apellido        = $request->apellido;
        $estudiante->fech_nacimiento        = $request->fech_nacimiento;
        $estudiante->sexo              = $request->sexo;
        $estudiante->dni              = $request->dni;
        $estudiante->direccion       = $request->direccion;
        $estudiante->condicion         = '1';
        $estudiante->save();
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
        $estudiante = Estudiante::findOrFail($request->id);
        $estudiante->aula_id          = $request->aula_id;
        $estudiante->nombre          = $request->nombre;
        $estudiante->apellido        = $request->apellido;
        $estudiante->fech_nacimiento        = $request->fech_nacimiento;
        $estudiante->sexo              = $request->sexo;
        $estudiante->dni              = $request->dni;
        $estudiante->direccion       = $request->direccion;
        $estudiante->condicion         = '1';
        $estudiante->save();
    }

    public function desactivar(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');    
        $estudiante = Estudiante::findOrFail($request->id);
        $estudiante->condicion = '0';
        $estudiante->save();
    }

    public function activar(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');
        $estudiante = Estudiante::findOrFail($request->id);
        $estudiante->condicion = '1';
        $estudiante->save();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
}
