<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaestroAula extends Model
{
    //
    protected $fillable=[

        'maestro_id','aula_id','condicion'
        // $table->integer('maestro_id')->unsigned();
        // $table->integer('aula_id')->unsigned();
        // $table->integer('curso_id')->unsigned();
        // $table->boolean('condicion')->default(1);
    ];
}
