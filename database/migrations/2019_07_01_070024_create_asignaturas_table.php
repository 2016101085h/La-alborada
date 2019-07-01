<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsignaturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignaturas', function (Blueprint $table) {
            $table->increments('id_asignatura');
            $table->string('asig_nombre');
            $table->text('asig_temario');
            $table->integer('idgrado')->unsigned();
            $table->boolean('condicion')->default(1);
            $table->timestamps();
            $table->foreign('idgrado')->references('id_grado')->on('grado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asignaturas');
    }
}
