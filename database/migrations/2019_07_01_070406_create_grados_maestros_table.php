<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradosMaestrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grados_maestros', function (Blueprint $table) {
            $table->integer('idgrado')->unsigned();
            $table->integer('idmaestro')->unsigned();
            $table->foreign('idgrado')->references('id_grado')->on('grado');
            $table->foreign('idmaestro')->references('id_maestro')->on('maestros');
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
        Schema::dropIfExists('grados_maestros');
    }
}
