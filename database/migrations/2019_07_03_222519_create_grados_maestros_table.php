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
            $table->increments('id');
            $table->integer('grado_id')->unsigned();
            $table->integer('maestro_id')->unsigned();
            $table->foreign('grado_id')->references('id')->on('grados')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('maestro_id')->references('id')->on('maestros')->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('condicion')->default(1);
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
