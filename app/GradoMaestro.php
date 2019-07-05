<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GradoMaestro extends Model
{
    protected $fillable = [
        'grado_id','maestro_id','condicion'
    ];
    // $table->increments('id');
    // $table->integer('grado_id')->unsigned();
    // $table->integer('maestro_id')->unsigned();
    // $table->foreign('grado_id')->references('id')->on('grados')->onDelete('cascade')->onUpdate('cascade');
    // $table->foreign('maestro_id')->references('id')->on('maestros')->onDelete('cascade')->onUpdate('cascade');
    // $table->boolean('condicion')->default(1);
    // $table->timestamps();
}
