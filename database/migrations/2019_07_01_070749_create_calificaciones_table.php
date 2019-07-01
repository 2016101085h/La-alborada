<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalificacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calificaciones', function (Blueprint $table) {
            $table->bigIncrements('id_calificacion');
            $table->integer('idalumno')->unsigned();
            $table->integer('cal_alumno');
            $table->integer('idgrado')->unsigned();
            $table->integer('idasignatura')->unsigned();
            $table->integer('cal_periodo');
            $table->string('calificacion_tipo',50);
            $table->timestamps();
            $table->foreign('idalumno')->references('id_alumno')->on('alumnos');
            $table->foreign('idgrado')->references('id_grado')->on('grado');
            $table->foreign('idasignatura')->references('id_asignatura')->on('asignaturas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calificaciones');
    }
}
