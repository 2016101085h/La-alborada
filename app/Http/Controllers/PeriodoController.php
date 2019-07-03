<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Periodo;

class PeriodoController extends Controller
{
    public function index(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');
        // $maestros = Maestro::all();
        // return $maestros;
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        if ($buscar == '') {

            $periodos = Periodo::orderBy('id', 'desc')->paginate(5);
        } else {
            $periodos = Periodo::where($criterio, 'like', '%' . $buscar . '%')->orderBy('id', 'desc')->paginate(2);
        }
        return [
            'pagination' => [
                'total' => $periodos->total(),
                'current_page' => $periodos->currentPage(),
                'per_page' => $periodos->perPage(),
                'last_page' => $periodos->lastPage(),
                'from' => $periodos->firstItem(),
                'to' => $periodos->lastItem(),
            ],
            'periodos'    => $periodos
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

        $grado = new Periodo();
        $grado->nombre = $request->nombre;
       
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
        $grado = Periodo::findOrFail($request->id);
        $grado->nombre = $request->nombre;
        
        $grado->save();
    }

    public function desactivar(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');    
        $grado = Periodo::findOrFail($request->id);
        $grado->condicion = '0';
        $grado->save();
    }

    public function activar(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');
        $grado = Periodo::findOrFail($request->id);
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
