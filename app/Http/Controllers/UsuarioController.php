<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
class UsuarioController extends Controller
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

            $usuarios = Usuario::join('rols', 'usuarios.rol_id', '=', 'rols.id')
            ->select(
                    'usuarios.id',
                    'usuarios.rol_id',
                    'rols.nombre',
                    'usuarios.usuario',

                    'usuarios.password',
                    'usuarios.condicion'
                )
                ->orderBy('usuarios.id', 'desc')->paginate(5);
        } else {
            $usuarios = Usuario::join('rols', 'usuarios.rol_id', '=', 'rols.id')-> select(
                'usuarios.id',
                'usuarios.rol_id',
                'rols.nombre',
                'usuarios.usuario',
                'usuarios.password',
                'usuarios.condicion'
            )
                ->where('usuarios.' . $criterio, 'like', '%' . $buscar . '%')->orderBy('usuarios.id', 'desc')->paginate(2);
            // $alumnos = Alumno::where($criterio, 'like', '%' . $buscar . '%')->orderBy('id', 'desc')->paginate(2);
        }
        return [
            'pagination' => [
                'total' => $usuarios->total(),
                'current_page' => $usuarios->currentPage(),
                'per_page' => $usuarios->perPage(),
                'last_page' => $usuarios->lastPage(),
                'from' => $usuarios->firstItem(),
                'to' => $usuarios->lastItem(),
            ],
            'usuarios'    => $usuarios
        ];
    }

    public function selectUsuario(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');
        $usuarios = Curso::where('condicion', '=', '1')->select('id', 'usuario','password',)->orderBy('nombre', 'asc')->get();
        return ['usuarios' => $usuarios];
    }

    /**returm $sdqw, -$wfwefwwrv    
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // if(!$request->ajax()) return redirect('/');

        $usuario = new Usuario();
        $usuario->rol_id          = $request->rol_id;
        $usuario->usuario          = $request->usuario;
        $usuario->password          = bcrypt($request->password);
        $usuario->condicion         = '1';
        $usuario->save();
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
        $usuario = Usuario::findOrFail($request->id);
        $usuario->rol_id          = $request->rol_id;
        $usuario->usuario          = $request->usuario;
        $usuario->password          = bcrypt($request->password);
        $usuario->condicion         = '1';
        $usuario->save();
    }

    public function desactivar(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');    
        $usuario = Usuario::findOrFail($request->id);
        $usuario->condicion = '0';
        $usuario->save();
    }

    public function activar(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');
        $usuario = Usuario::findOrFail($request->id);
        $usuario->condicion = '1';
        $usuario->save();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
}
