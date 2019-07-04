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
            $table->increments('id');
            $table->string('nombre');
            $table->text('temario');
            
            $table->integer('maestro_id')->unsigned();
            $table->integer('grado_id')->unsigned();
            $table->boolean('condicion')->default(1);
            $table->timestamps();
<<<<<<< HEAD:database/migrations/2019_07_01_070024_create_asignaturas_table.php
=======
            
            $table->foreign('maestro_id')->references('id')->on('maestros')->onDelete('cascade')->onUpdate('cascade');
>>>>>>> master:database/migrations/2019_07_03_222426_create_asignaturas_table.php
            $table->foreign('grado_id')->references('id')->on('grados')->onDelete('cascade')->onUpdate('cascade');
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
