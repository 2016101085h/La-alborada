<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlumnoAsignatura extends Model
{
    protected $fillable = [
        'alumno_id', 'asignatura_id',  'condicion'
    ];
    // public function alumno()
    // {
    //     return $this->belongsTo('App\Alumno');
    // }
    // public function asignatura()
    // {
    //     return $this->belongsTo('App\Asignatura');
    // }
    // $table->increments ('id');
    // $table->integer('alumno_id')->unsigned();
    // $table->integer('asignatura_id')->unsigned();
    // $table->boolean('condicion')->default(1);
    // $table->foreign('alumno_id')->references('id')->on('alumnos')->onDelete('cascade')->onUpdate('cascade');
    // $table->foreign('asignatura_id')->references('id')->on('asignaturas')->onDelete('cascade')->onUpdate('cascade');
    // $table->timestamps();
}
