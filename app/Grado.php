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
}
