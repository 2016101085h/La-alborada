<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $fillable = [
        'nombre', 'apellido', 'fech_nacimiento', 'sexo', 'dni',
        'direccion', 'num_celular', 'condicion'
    ];
    public function maestro()
    {
        return $this->belongsTo('App\Maestro');
    }
    public function padre()
    {
        return $this->hasMany('App\Padre');
    }
        
}
