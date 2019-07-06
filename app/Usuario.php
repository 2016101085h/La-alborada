<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $fillable=[
        'rol_id', 'usuario', 'password', 'condicion'
    ];
    // $table->increments ('id');
    // $table->integer('rol_id')->unsigned();
    // $table->string('usuario', 50);
    // $table->string('password', 50);
    // $table->boolean('condicion')->default(1);
    // $table->timestamps();
    // $table->foreign('rol_id')->references('id')->on('rols');
    public function rol()
    {
        return $this->hasOne('App\Rol');
    }
}
