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
            
            $table->integer('id')->unsigned();
            $table->integer('aula_id')->unsigned();
            $table->integer('curso_id')->unsigned();
            $table->boolean('condicion')->default(1);
            $table->timestamps();
            $table->foreign('id')->references('id')->on('personas');
            $table->foreign('aula_id')->references('id')->on('aulas');
            $table->foreign('curso_id')->references('id')->on('cursos');
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
