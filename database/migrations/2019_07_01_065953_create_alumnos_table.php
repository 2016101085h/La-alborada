<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlumnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('grado_id')->unsigned();
            $table->string('nombre', 50);
            $table->string('apellido', 100);
            $table->string('sexo', 50);
            $table->date('fech_nacimiento');
            $table->longText('direccion', 200);
            $table->boolean('condicion')->default(1);
            $table->timestamps();
            $table->foreign('grado_id')->references('id')->on('grado')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alumnos');
    }
}
