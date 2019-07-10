<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    protected $fillable=[
        'aula_id','nombre','apellido','fech_nacimiento','sexo','direccion','dni','condicion'
    ];
    public function aula()
    {
        return $this->belongsTo('App\Aula');
    }
    public function maestro()
    {
        return $this->belongsTo('App\Maestro');
    }
    public function cursos()
    {
        return $this->hasMany('App\Curso');
    }
    public function notas()
    {
        return $this->hasMany('App\Nota');
    }
}
