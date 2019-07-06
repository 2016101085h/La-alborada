<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstudiantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('aula_id')->unsigned();
            $table->string('nombre',50);
            $table->string('apellido',100);
            $table->date('fech_nacimiento');
            $table->string('sexo',50);
            $table->integer('dni');
            $table->string('direccion',256);
            $table->boolean('condicion')->default(1);
            $table->timestamps();
            $table->foreign('aula_id')->references('id')->on('aulas')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estudiantes');
    }
}
