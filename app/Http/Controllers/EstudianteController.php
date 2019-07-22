<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estudiante;

class EstudianteController extends Controller
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

            $estudiantes = Estudiante::join('aulas', 'estudiantes.aula_id', '=', 'aulas.id')
                ->select(
                    'estudiantes.id',
                    'estudiantes.aula_id','aulas.grado','aulas.seccion',
                    'estudiantes.nombre',
                    'estudiantes.apellido',
                    'estudiantes.fech_nacimiento',
                    'estudiantes.dni',
                    'estudiantes.sexo',
                    'estudiantes.direccion',
                    'estudiantes.condicion'
                )
                ->orderBy('estudiantes.id', 'asc')->paginate(10);
        } else {
            $estudiantes = Estudiante::join('aulas', 'estudiantes.aula_id', '=', 'aulas.id')
                ->select(
                    'estudiantes.id',
                    'estudiantes.aula_id',
                    'aulas.grado',
                    'aulas.seccion',
                    'estudiantes.nombre',
                    'estudiantes.apellido',
                    'estudiantes.fech_nacimiento',
                    'estudiantes.dni',
                    'estudiantes.sexo',
                    'estudiantes.direccion',
                    'estudiantes.condicion'
                )
                ->where('estudiantes.' . $criterio, 'like', '%' . $buscar . '%')
                ->orderBy('estudiantes.id', 'asc')->paginate(2);
            // $estudiantes = Estudiante::where($criterio, 'like', '%' . $buscar . '%')->orderBy('id', 'desc')->paginate(2);
        }
        return [
            'pagination' => [
                'total' => $estudiantes->total(),
                'current_page' => $estudiantes->currentPage(),
                'per_page' => $estudiantes->perPage(),
                'last_page' => $estudiantes->lastPage(),
                'from' => $estudiantes->firstItem(),
                'to' => $estudiantes->lastItem(),
            ],
            'estudiantes'    => $estudiantes
        ];
    }
    public function listarPdf()
    {
        $estudiantes = Estudiante::join('aulas', 'estudiantes.aula_id', '=', 'aulas.id')
            ->select(
                'estudiantes.id',
                'estudiantes.aula_id',
                'aulas.grado',
                'aulas.seccion',
                'estudiantes.nombre',
                'estudiantes.apellido',
                'estudiantes.fech_nacimiento',
                'estudiantes.dni',
                'estudiantes.sexo',
                'estudiantes.direccion',
                'estudiantes.condicion'
            )
            ->orderBy('estudiantes.id', 'asc')->get();
        $cont = Estudiante::count();

        $pdf = \PDF::loadView('pdf.estudiantespdf', ['estudiantes' => $estudiantes, 'cont' => $cont]);
        return $pdf->download('estudiantes.pdf');
    }
    public function selectEstudiante(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');
        $estudiantes = Estudiante::where('condicion', '=', '1')->select('id', 'nombre', 'apellido')->orderBy('nombre', 'asc')->get();
        return ['estudiantes' => $estudiantes];
    }
    public function buscarEstudiante(Request $request){
        $aula_id = $request ->aula_id;
        

        $estudiantes = Estudiante::join('aulas','estudiantes.aula_id','=','aulas.id')->select(
            'estudiantes.id','estudiantes.nombre','estudiantes.apellido','aulas.seccion','aulas.grado'
        )->where('estudiantes.id','=',$aula_id)->orderBy('estudiantes.id','asc')->get();
        return [

            'estudiantes' => $estudiantes
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

        $estudiante = new Estudiante();
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
