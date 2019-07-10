<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Persona;
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
        // $maestros = Maestro::all();
        // return $maestros;
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        if ($buscar == '') {
            $personas = Maestro::join('personas', 'maestros.id', '=', 'personas.id')
                ->select(
                    'personas.id',
                    'personas.nombre',
                    'personas.apellido',
                    'personas.fech_nacimiento',
                    'personas.sexo',
                    'personas.dni',
                    'personas.direccion',
                    'personas.num_celular',
                    'maestros.grado_instruccion',
                    'maestros.condicion'
                )
                ->orderBy('personas.id', 'desc')->paginate(3);
        } else {
            $personas = Maestro::join('personas', 'maestros.id', '=', 'personas.id')
                ->select(
                    'personas.id',
                    'personas.nombre',
                    'personas.apellido',
                    'personas.fech_nacimiento',
                    'personas.sexo',
                    'personas.dni',
                    'personas.direccion',
                    'personas.num_celular',
                    'maestros.grado_instruccion',
                    'maestros.condicion'
                )
                ->where('personas.' . $criterio, 'like', '%' . $buscar . '%')
                ->orderBy('personas.id', 'desc')->paginate(3);
        }
        
        return [
            'pagination' => [
                'total' => $personas->total(),
                'current_page' => $personas->currentPage(),
                'per_page' => $personas->perPage(),
                'last_page' => $personas->lastPage(),
                'from' => $personas->firstItem(),
                'to' => $personas->lastItem(),
            ],
            'personas'    => $personas
        ];
    }
    public function selectMaestro(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');
        $personas = Persona::where('condicion', '=', '1')->select('id', 'nombre', 'apellido')->orderBy('nombre', 'asc')->get();
        return ['personas' => $personas];
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
            $persona->fech_nacimiento = $request->fech_nacimiento;
            $persona->sexo = $request->sexo;
            $persona->dni = $request->dni;
            $persona->direccion = $request->direccion;
            $persona->num_celular = $request->num_celular;
            $persona->save();

            $maestro = new Maestro();
            $maestro->grado_instruccion = $request->grado_instruccion;
            $maestro->id = $persona->id;
            $maestro->save();

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
            $maestro = Maestro::findOrFail($request->id);
            $persona = Persona::findOrFail($maestro->id);

            $persona->nombre = $request->nombre;
            $persona->apellido = $request->apellido;
            $persona->fech_nacimiento = $request->fech_nacimiento;
            $persona->sexo = $request->sexo;
            $persona->dni = $request->dni;
            $persona->direccion = $request->direccion;
            $persona->num_celular = $request->num_celular;
            $persona->save();

            
            $maestro->grado_instruccion = $request->grado_instruccion;
            $maestro->id = $persona->id;
            $maestro->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }   
    }

    public function desactivar(Request $request){
          // if(!$request->ajax()) return redirect('/');    
        $maestro = Maestro::findOrFail($request->id);
        $maestro->condicion = '0';
        $maestro->save();
    }

    public function activar(Request $request){
          // if(!$request->ajax()) return redirect('/');
        $maestro = Maestro::findOrFail($request->id);
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
