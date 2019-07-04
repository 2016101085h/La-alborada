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
<<<<<<< HEAD
        $maestros = Maestro::all();
        return ['maestros' => $maestros];
    }
=======
        // $maestros = Maestro::all();
        // return $maestros;
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        if($buscar == ''){

            $maestros= Maestro::orderBy('id','desc')->paginate(5);
        }
        else{
            $maestros = Maestro::where($criterio,'like', '%'. $buscar . '%')->orderBy('id', 'desc')->paginate(2);
>>>>>>> master

        }
        return [
            'pagination' => [
                'total' => $maestros->total(),
                'current_page' => $maestros->currentPage(),
                'per_page' => $maestros->perPage(),
                'last_page' => $maestros->lastPage(),
                'from' => $maestros->firstItem(),
                'to' => $maestros->lastItem(),
            ],
            'maestros'    => $maestros
        ];
    }
    public function selectMaestro(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');
        $maestros = Maestro::where('condicion', '=', '1')->select('id', 'nombre', 'apellido')->orderBy('nombre', 'asc')->get();
        return ['maestros' => $maestros];
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
        $maestro->nombre          = $request->nombre;
        $maestro->apellido        = $request->apellido;
        $maestro->fech_nacimiento        = $request->fech_nacimiento;
        $maestro->sexo              = $request->sexo;
        $maestro->grado_instruccion  = $request->grado_instruccion;
        $maestro->direccion       = $request->direccion;
        $maestro->num_celular       = $request->num_celular;
        $maestro->condicion         = '1';
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
        $maestro = Maestro::findOrFail($request->id);
        $maestro->nombre          = $request->nombre;
        $maestro->apellido        = $request->apellido;
        $maestro->fech_nacimiento    = $request->fech_nacimiento;
        $maestro->sexo              = $request->sexo;
        $maestro->grado_instruccion  = $request->grado_instruccion;
        $maestro->direccion       = $request->direccion;
        $maestro->num_celular       = $request->num_celular;
        $maestro->condicion         = '1';
        $maestro->save();
    }

    public function desactivar(Request $request){
          // if(!$request->ajax()) return redirect('/');    
        $maestro = Maestro::findOrFail($request->id);
        $maestro->condicion = '0';
        $maestro->save();
    }

    public function activar(Request $request){
<<<<<<< HEAD
=======
          // if(!$request->ajax()) return redirect('/');
>>>>>>> master
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
