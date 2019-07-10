<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
  
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected $fillable = [
        'id','rol_id', 'usuario', 'password', 'condicion'
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
        return $this->belongsTo('App\Rol');
    }

    public function persona()
    {
        return $this->belongsTo('App\Persona');
    }
}
