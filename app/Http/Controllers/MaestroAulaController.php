<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\MaestroAula;



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
            $maestro_aulas = MaestroAula::join('maestros', 'maestro_aulas.maestro_id', '=', 'maestros.id')->join('aulas','maestro_aulas.aula_id','=','aulas.id')
                ->select(
                    'maestro_aulas.id',
                    'maestro_aulas.maestro_id',
                    'maestros.nombre',
                    'maestros.apellido',
                    'maestro_aulas.aula_id',
                    'aulas.seccion',
                    'aulas.grado',
                    'maestro_aulas.condicion'
                )
                ->orderBy('maestro_aulas.id', 'desc')->paginate(3);
        } else {
            $maestro_aulas = MaestroAula::join('maestros', 'maestro_aulas.maestro_id', '=', 'maestros.id')->join('aulas', 'maestro_aulas.aula_id', '=', 'aulas.id')
                ->select(
                    'maestro_aulas.id',
                    'maestro_aulas.maestro_id',
                    'maestros.nombre',
                    'maestros.apellido',
                    'maestro_aulas.aula_id',
                    'aulas.seccion',
                    'aulas.grado',
                    'maestro_aulas.condicion'
                )
                ->where('aulas.' . $criterio, 'like', '%' . $buscar . '%')
                ->orderBy('maestros.id', 'desc')->paginate(3);
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

    public function listarPdf()
    {
        $maestro_aulas = MaestroAula::join('maestros', 'maestro_aulas.maestro_id', '=', 'maestros.id')->join('aulas', 'maestro_aulas.aula_id', '=', 'aulas.id')
            ->select(
                'maestro_aulas.id',
                'maestro_aulas.maestro_id',
                'maestros.nombre',
                'maestros.apellido',
                'maestro_aulas.aula_id',
                'aulas.seccion',
                'aulas.grado',
                'maestro_aulas.condicion'
            )
            ->orderBy('maestro_aulas.id', 'asc')->get();
        $cont = MaestroAula::count();

        $pdf = \PDF::loadView('pdf.maestroaulaspdf', ['maestro_aulas' => $maestro_aulas, 'cont' => $cont]);
        return $pdf->download('maestroaulas.pdf');
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
    
            $maestro_aula = new MaestroAula();   
            $maestro_aula->maestro_id = $request->maestro_id;
            $maestro_aula->aula_id = $request->aula_id;
            $maestro_aula->condicion = '1';
            $maestro_aula->save();

        
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
       
            $maestro_aula = Maestroaula::findOrFail($request->id);
            $maestro_aula->maestro_id = $request->maestro_id;
            $maestro_aula->aula_id = $request->aula_id;
            $maestro_aula->condicion = '1';
            $maestro_aula->save();


           

           
        
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
