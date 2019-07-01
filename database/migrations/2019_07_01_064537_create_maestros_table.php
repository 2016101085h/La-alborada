<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaestrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maestros', function (Blueprint $table) {
            $table->increments('id_maestro');
            $table->string('m_nombre',50);
            $table->string('m_apellido',100);
            $table->date('m_fech_nac');
            $table->string('sexo',50);
            $table->string('grado_intruccion',50);
            $table->longText('m_direccion',200);
            $table->integer('num_celular');
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
        Schema::dropIfExists('maestros');
    }
}
