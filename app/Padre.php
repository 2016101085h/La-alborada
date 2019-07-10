<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Padre extends Model
{
    protected $fillable= [
        'estudiante_id','nombre','apellido','dni','num_celular','condicion'
    ];

    // Schema::create ('padres', function(Blueprint $table)
    // {
    //     $table->increments('id');
    //     $table->integer('estudiante_id')->unsigned();
    //     $table->string('nombre' ,50);
    //     $table->string('apellido' ,100);
    //     $table->integer('dni');
    //     $table->integer('num_celular');
    //     $table->boolean('condicion')->default(1);
    //     $table->timestamps();
    //     $table->foreign('estudiante_id')->references('id')->on('estudiantes')->onDelete('cascade')->onUpdate('cascade');
    // });
    public function estudiantes()
    {
        return $this->hasMany('App\Estudiante');
    }
}

