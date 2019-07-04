<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\{Alumno, Grado};
use Illuminate\Http\Request;
=======
use Illuminate\Http\Request;
use App\Alumno;
>>>>>>> master

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
<<<<<<< HEAD
    public function index()
    {
        $alumnos = Alumno::join('grados', 'alumnos.grado_id', '=', 'grados.id')->select('alumnos.id', 'alumnos.grado_id', 'alumnos.nombre', 'alumnos.apellido','alumnos.sexo', 'alumnos.fech_nacimiento', 'alumnos.direccion', 'alumnos.condicion', 'grados.seccion')->orderBy('alumnos.id', 'desc')->get();

        $grados = Grado::all();   

        return [
            'alumnos' => $alumnos,
            'grados' => $grados
        ];
    }

=======
    public function index(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');
        // $maestros = Maestro::all();
        // return $maestros;
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        if ($buscar == '') {

            $alumnos = Alumno::join('grados','alumnos.grado_id','=','grados.id')
            ->select('alumnos.id','alumnos.grado_id','alumnos.nombre','alumnos.apellido','alumnos.fech_nacimiento', 
            'grados.grado as grado', 'grados.seccion as seccion_grado', 'grados.turno as turno_grado' ,'alumnos.sexo','alumnos.direccion','alumnos.condicion')
            ->orderBy('alumnos.id', 'desc')->paginate(5);
        } else {
            $alumnos = Alumno::join('grados', 'alumnos.grado_id', '=', 'grados.id')
                ->select('alumnos.id','alumnos.grado_id','alumnos.nombre','alumnos.apellido','alumnos.fech_nacimiento',
                    'grados.grado as grado','grados.seccion as seccion_grado','grados.turno as turno_grado', 'alumnos.sexo','alumnos.direccion','alumnos.condicion')->
            where('alumnos.'.$criterio, 'like', '%' . $buscar . '%')
            ->orderBy('alumnos.id', 'desc')->paginate(2);
            // $alumnos = Alumno::where($criterio, 'like', '%' . $buscar . '%')->orderBy('id', 'desc')->paginate(2);
        }
        return [
            'pagination' => [
                'total' => $alumnos->total(),
                'current_page' => $alumnos->currentPage(),
                'per_page' => $alumnos->perPage(),
                'last_page' => $alumnos->lastPage(),
                'from' => $alumnos->firstItem(),
                'to' => $alumnos->lastItem(),
            ],
            'alumnos'    => $alumnos
        ];
    }

    

>>>>>>> master
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
<<<<<<< HEAD
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

=======

        // if(!$request->ajax()) return redirect('/');

        $alumno = new Alumno();
        $alumno->grado_id          = $request->grado_id;
        $alumno->nombre          = $request->nombre;
        $alumno->apellido        = $request->apellido;
        $alumno->fech_nacimiento        = $request->fech_nacimiento;
        $alumno->sexo              = $request->sexo;
        $alumno->direccion       = $request->direccion;
        $alumno->condicion         = '1';
        $alumno->save();
    }




>>>>>>> master
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
<<<<<<< HEAD
     * @param  \App\Alumno  $alumno
=======
     * @param  int  $id
>>>>>>> master
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
<<<<<<< HEAD
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
=======
        // if(!$request->ajax()) return redirect('/');
        $alumno = Alumno::findOrFail($request->id);
        $alumno->grado_id          = $request->grado_id;
        $alumno->nombre          = $request->nombre;
        $alumno->apellido        = $request->apellido;
        $alumno->fech_nacimiento        = $request->fech_nacimiento;
        $alumno->sexo              = $request->sexo;
        $alumno->direccion       = $request->direccion;
        $alumno->condicion         = '1';
        $alumno->save();
    }

    public function desactivar(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');    
        $alumno = Alumno::findOrFail($request->id);
        $alumno->condicion = '0';
        $alumno->save();
    }

    public function activar(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');
        $alumno = Alumno::findOrFail($request->id);
        $alumno->condicion = '1';
        $alumno->save();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
>>>>>>> master
}
