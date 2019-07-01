<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePadresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('padres', function (Blueprint $table) {
            $table->increments('id_padre');
            $table->integer('idalumno')->unsigned();
            $table->string('p_nombre',50);
            $table->string('p_apellido',0);
            $table->string('p_dni');
            $table->string('p_sexo');
            $table->boolean('condicion')->default(1);
            $table->timestamps();
            $table->foreign('idalumno')->references('id_alumno')->on('alumnos')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('padres');
    }
}
