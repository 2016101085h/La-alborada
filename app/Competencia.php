<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competencia extends Model
{
    protected $fillable=[
        'curso_id','nombre','condicion'
    ];
    //
    public function nota()
    {
        return $this->hasOne('App\Nota');
    }
}
