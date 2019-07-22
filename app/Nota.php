<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    //
    protected $fillable = [
        'competencia_id', 'estudiante_id', 'curso_id', 'periodo_id', 'calificacion', 'condicion'
    ];
    // $table->increments ('id');
    // $table->integer('competencia_id')->unsigned();
    // $table->integer('estudiante_id')->unsigned();
    // $table->integer('curso_id')->unsigned();
    // $table->integer('periodo_id')->unsigned();
    // $table->integer('calificacion');
    // $table->boolean('condicion')->default(1);
    // $table->timestamps();
    public function competencia()
    {
        return $this->belongsTo('App\Competencia');
    }
    public function estudiante()
    {
        return $this->belongsTo('App\Estudiante');
    }
}
