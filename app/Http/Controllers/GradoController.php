<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Grado;

class GradoController extends Controller
{
    public function index(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');
        // $maestros = Maestro::all();
        // return $maestros;
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        if ($buscar == '') {

            $grados = Grado::orderBy('id', 'desc')->paginate(5);
        } else {
            $grados = Grado::where($criterio, 'like', '%' . $buscar . '%')->orderBy('id', 'desc')->paginate(2);
        }
        return [
            'pagination' => [
                'total' => $grados->total(),
                'current_page' => $grados->currentPage(),
                'per_page' => $grados->perPage(),
                'last_page' => $grados->lastPage(),
                'from' => $grados->firstItem(),
                'to' => $grados->lastItem(),
            ],
            'grados'    => $grados
        ];
    }

    public function selectGrado(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');
        $grados = Grado::where('condicion', '=', '1')->select('id', 'grado', 'seccion', 'turno')->orderBy('grado', 'asc')->get();
        return ['grados' => $grados];
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

        $grado = new Grado();
        $grado->grado = $request->grado;
        $grado->seccion = $request->seccion;
        $grado->turno = $request->turno;
        $grado->save();
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
        $grado = Grado::findOrFail($request->id);
        $grado->grado = $request->grado;
        $grado->seccion = $request->seccion;
        $grado->turno = $request->turno;
        $grado->save();
        
    }

    public function desactivar(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');    
        $grado = Grado::findOrFail($request->id);
        $grado->condicion = '0';
        $grado->save();
    }

    public function activar(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');
        $grado = Grado::findOrFail($request->id);
        $grado->condicion = '1';
        $grado->save();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

}
