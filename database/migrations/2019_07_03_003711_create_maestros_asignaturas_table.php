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
            $table->integer('maestro_id')->unsigned();
            $table->integer('asignatura_id')->unsigned();
            $table->foreign('maestro_id')->references('id')->on('maestros')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('asignatura_id')->references('id')->on('asignaturas')->onDelete('cascade')->onUpdate('cascade');
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
