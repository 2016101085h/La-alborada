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
            $table->integer('idgrado')->unsigned();
            $table->integer('idasignatura')->unsigned();
            $table->integer('cal_periodo');
            $table->string('calificacion_tipo', 50);
            $table->integer('idperiodo')->unsigned();
            $table->timestamps();
            $table->foreign('idalumno')->references('id_alumno')->on('alumnos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('idgrado')->references('id_grado')->on('grado')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('idasignatura')->references('id_asignatura')->on('asignaturas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('idperiodo')->references('id_periodo')->on('periodos')->onDelete('cascade')->onUpdate('cascade');
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
