<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
	protected $fillable = ['grado_id', 'nombre', 'apellido', 'sexo', 'fech_nacimiento', 'direccion', 'condicion'];    
}
