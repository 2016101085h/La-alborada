<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maestro extends Model
{
    protected $fillable = ['nombre','apellido','fech_nacimiento','sexo','grado_instruccion','dni',
    'direccion','num_celular','condicion'];
        public function aula()
        {
            return $this->belongsTo('App\Aula');
        }
        public function cursos()
        {
            return $this->hasMany('App\Curso');
        }
        

        // $table->increments('id');
        // $table->string('nombre',50);
        // $table->string('apellido',100);
        // $table->date('fech_nacimiento');
        // $table->string('sexo',50);
        // $table->string('grado_instruccion',50);
        // $table->string('dni');
        // $table->string('direccion',256);
        // $table->string('num_celular');
        // $table->boolean('condicion')->default(1);
        // $table->timestamps();
        
}
