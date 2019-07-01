<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maestro extends Model
{
    protected $filiable = ['m_nombre','m_apellido','m_fech_nac','sexo','grado_intruccion',
'm_direccion','num_celular','condicion'];
}
// $table->string('m_nombre', 50);
// $table->string('m_apellido', 100);
// $table->date('m_fech_nac');
// $table->string('sexo', 50);
// $table->string('grado_intruccion', 50);
// $table->longText('m_direccion', 200);
// $table->integer('num_celular');
// $table->boolean('condicion');