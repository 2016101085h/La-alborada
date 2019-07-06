<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
   protected $fillable =[
    'nombre','condicion'
   ];
   public function estudiante()
   {
      return $this->belongsTo('App\Estudiante');
   }
}
