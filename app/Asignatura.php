<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    protected $fillable = [
        'nombre', 'temario', 'maestro_id', 'grado_id', 'condicion', 
    ];
    public function grado()
    {
        return $this->belongsTo('App\Grado');
    }
    public function maestro()
    {
        return $this->belongsTo('App\Maestro');
    }
    // public function alumnoasignaturas()
    // {
    //     return $this->hasMany('App\AlumnoAsignatura');
    // }
    // $table->increments ('id');
    // $table->string('nombre');
    // $table->text('temario');
    // $table->integer('maestro_id')->unsigned();
    // $table->integer('grado_id')->unsigned();
    // $table->boolean('condicion')->default(1);
}
