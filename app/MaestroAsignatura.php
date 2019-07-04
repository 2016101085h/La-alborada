<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaestroAsignatura extends Model
{
    protected $fillable = [
        'maestro_id', 'asignatura_id',  'condicion'
    ];
    // public function alumno()
    // {
    //     return $this->belongsTo('App\Maestro');
    // }
    // public function asignatura()
    // {
    //     return $this->belongsTo('App\Asignatura');
    // }
}
