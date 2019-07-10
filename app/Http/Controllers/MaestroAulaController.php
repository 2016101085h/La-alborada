<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\MaestroAula;
use App\Persona;
use App\Maestro;
use App\Aula;


class MaestroAulaController extends Controller
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
            $maestro_aulas = MaestroAula::join('personas', 'maestro_aulas.id', '=', 'personas.id')->
            join('cursos','maestro_aulas.curso_id','=','cursos.id')
            ->join('aulas','maestro_aulas.aula_id','=','aulas.id')
                ->select(
                    'personas.id',
                    'personas.nombre',
                    'personas.apellido',
                 
                    'aulas.seccion',
                    'aulas.grado','cursos.nombre as nombre_curso',
                    'maestro_aulas.condicion'
                )
                ->orderBy('personas.id', 'desc')->paginate(3);
        } else {
            $maestro_aulas = MaestroAula::join('personas', 'maestro_aulas.id', '=', 'personas.id')->join('cursos', 'maestro_aulas.curso_id', '=', 'cursos.id')
                ->join('aulas', 'maestro_aulas.aula_id', '=', 'aulas.id')
                ->select(
                    'personas.id',
                    'personas.nombre',
                    'personas.apellido',
                    
                    'aulas.seccion',
                    'aulas.grado',
                    'cursos.nombre as nombre_curso',
                    'maestro_aulas.condicion'
                )
                ->where('personas.' . $criterio, 'like', '%' . $buscar . '%')
                ->orderBy('personas.id', 'desc')->paginate(3);
        }

        return [
            'pagination' => [
                'total' => $maestro_aulas->total(),
                'current_page' => $maestro_aulas->currentPage(),
                'per_page' => $maestro_aulas->perPage(),
                'last_page' => $maestro_aulas->lastPage(),
                'from' => $maestro_aulas->firstItem(),
                'to' => $maestro_aulas->lastItem(),
            ],
            'maestro_aulas'    => $maestro_aulas
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
        try {
            DB::beginTransaction();
            $persona = new Persona();
            $persona->nombre = $request->nombre;
            $persona->apellido = $request->apellido;
            $persona->save();

            $aula = new Aula();
            $aula->seccion = $request->seccion;
            $aula->grado = $persona->grado;
            $aula->save();


            $curso = new Curso();
            $curso->nombre = $request->nombre_curso;           
            $curso->save();

            $maestro_aula = new MaestroAula();   
            $maestro_aula->id = $persona->id;
            $maestro_aula->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
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
        try {
            DB::beginTransaction();
            $maestro_aula = Maestro::findOrFail($request->id);
            $aula = Aula::find($request->id);
            $curso = Curso::find($request->id);
            $persona = Persona::findOrFail($maestro_aula->id);

            $persona->nombre = $request->nombre;
            $persona->apellido = $request->apellido;
            $persona->save();

            $aula->seccion = $request->seccion;
            $aula->grado = $persona->grado;
            $aula->save();

            $curso->nombre = $request->nombre_curso; 
            $curso->save();

        

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    public function desactivar(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');    
        $maestro_aula = MaestroAula::findOrFail($request->id);
        $maestro_aula->condicion = '0';
        $maestro_aula->save();
    }

    public function activar(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');
        $maestro_aula = MaestroAula::findOrFail($request->id);
        $maestro_aula->condicion = '1';
        $maestro_aula->save();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
}
