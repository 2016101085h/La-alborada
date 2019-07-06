<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    //
    public function competencia()
    {
        return $this->belongsTo('App\Competencia');
    }
}
