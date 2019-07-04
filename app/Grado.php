<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grado extends Model
{
<<<<<<< HEAD
    protected $fillable = ['seccion', 'turno'];
=======
    protected $fillable = [
        'grado','seccion',  'turno','condicion'
    ];
    public function alumnos()
    {
        return $this->hasMany('App\Alumno');
    }
    public function asignaturas()
    {
        return $this->hasMany('App\Asignatura');
    }
>>>>>>> master
}
