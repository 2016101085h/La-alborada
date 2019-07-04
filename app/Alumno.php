<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    protected $fillable=[
        'grado_id','nombre','apellido','sexo','fech_nacimiento','direccion','condicion'
    ];
    public function grado()
    {
        return $this->belongsTo('App\Grado');
    }
    public function alumnoasignaturas()
    {
        return $this->hasMany('App\AlumnoAsignatura');
    }
    // $table->increments ('id');
    // $table->integer('grado_id')->unsigned();
    // $table->string('nombre', 50);
    // $table->string('apellido', 100);
    // $table->string('sexo', 50);
    // $table->date('fech_nacimiento');
    // $table->longText('direccion', 200);
    // $table->boolean('condicion')->default(1);
    // $table->timestamps();
    // $table->foreign('grado_id')->references('id')->on('grados')->onDelete('cascade')->onUpdate('cascade');
}
