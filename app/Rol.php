<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
protected $fillable=[
    'nombre','descripcion','condicion'
];
    public function usuario()
    {
        return $this->belongsTo('App\Usuario');
    }
}
