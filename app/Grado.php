<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grado extends Model
{
    protected $fillable = [
        'grado','seccion',  'turno','condicion'
    ];
    public function alumnos()
    {
        return $this->hasMany('App\Alumno');
    }
    public function maestros()
    {
        return $this->hasMany('App\Maestro');
    }
    public function asignaturas()
    {
        return $this->hasMany('App\Asignatura');
    }
}
