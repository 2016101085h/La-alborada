<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    protected $fillable = [
        'seccion','grado','condicion'
    ];
    public function estudiantes()
    {
        return $this->hasMany('App\Estudiante');
    }
    public function maestros()
    {
        return $this->hasMany('App\Maestro');
    }
    public function cursos()
    {
        return $this->hasMany('App\Curso');
    }
}
