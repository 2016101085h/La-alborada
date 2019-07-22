<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aula;

class AulaController extends Controller
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
        if($buscar == ''){

            $aulas= Aula::orderBy('id','desc')->paginate(15);
        }
        else{
            $aulas = Aula::where($criterio,'like', '%'. $buscar . '%')->orderBy('id', 'desc')->paginate(2);

        }
        return [
            'pagination' => [
                'total' => $aulas->total(),
                'current_page' => $aulas->currentPage(),
                'per_page' => $aulas->perPage(),
                'last_page' => $aulas->lastPage(),
                'from' => $aulas->firstItem(),
                'to' => $aulas->lastItem(),
            ],
            'aulas'    => $aulas
        ];
    }
    public function selectAula(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');
        $aulas = Aula::where('condicion', '=', '1')->select('id', 'seccion', 'grado','condicion')->orderBy('grado', 'asc')->get();
        return ['aulas' => $aulas];
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
        
        $aula=new Aula();
        $aula->seccion          = $request->seccion;
        $aula->grado        = $request->grado;
        $aula->condicion         = '1';
        $aula->save();
        
     

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
        $aula = Aula::findOrFail($request->id);
        $aula->seccion          = $request->seccion;
        $aula->grado        = $request->grado;
        $aula->condicion         = '1';
        $aula->save();
    }

    public function desactivar(Request $request){
          // if(!$request->ajax()) return redirect('/');    
        $aula = Aula::findOrFail($request->id);
        $aula->condicion = '0';
        $aula->save();
    }

    public function activar(Request $request){
          // if(!$request->ajax()) return redirect('/');
        $aula = Aula::findOrFail($request->id);
        $aula->condicion = '1';
        $aula->save();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
}
