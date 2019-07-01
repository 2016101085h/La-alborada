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
            $table->increments('id_alumno');
            $table->integer('idgrado')->unsigned();
            $table->string('alum_nombre', 50);
            $table->string('alum_apellido', 100);
            $table->string('alum_sexo', 50);
            $table->date('alum_fech_nac');
            $table->longText('direccion', 200);
            $table->boolean('condicion')->default(1);
            $table->timestamps();
            $table->foreign('idgrado')->references('id_grado')->on('grado')->onDelete('cascade')->onUpdate('cascade');
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
