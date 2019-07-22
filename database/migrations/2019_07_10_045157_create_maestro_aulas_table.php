<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaestroAulasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maestro_aulas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('maestro_id')->unsigned();
            $table->integer('aula_id')->unsigned();
          
           
            $table->boolean('condicion')->default(1);
            $table->timestamps();
            $table->foreign('maestro_id')->references('id')->on('maestros');
            $table->foreign('aula_id')->references('id')->on('aulas');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('maestro_aulas');
    }
}
