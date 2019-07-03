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
            $table->integer('alumno_id')->unsigned();
            $table->string('nombre', 50);
            $table->string('apellido', 0);
            $table->string('dni');
            $table->string('sexo');
            $table->boolean('condicion')->default(1);
            $table->timestamps();
            $table->foreign('alumno_id')->references('id')->on('alumnos')->onDelete('cascade')->onUpdate('cascade');
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
