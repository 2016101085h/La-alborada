<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 50)->nullable();
            $table->string('apellido', 100)->nullable();
            $table->date('fech_nacimiento')->nullable();
            $table->string('sexo', 50)->nullable();
            $table->string('dni')->nullable();
            $table->string('direccion', 256)->nullable();
            $table->string('num_celular')->nullable();
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
        Schema::dropIfExists('personas');
    }
}
