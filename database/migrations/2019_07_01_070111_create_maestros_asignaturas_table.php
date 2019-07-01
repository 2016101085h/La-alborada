<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaestrosAsignaturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maestros_asignaturas', function (Blueprint $table) {
            $table->integer('idmaestro')->unsigned();
            $table->integer('idasignatura')->unsigned();
            $table->foreign('idmaestro')->references('id_maestro')->on('maestros')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('idasignatura')->references('id_asignatura')->on('asignaturas')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('maestros_asignaturas');
    }
}
