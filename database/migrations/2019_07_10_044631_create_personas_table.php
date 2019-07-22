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
        DB::table('personas')->insert(array(
            'id' => '1', 'nombre' => 'Frank', 'apellido' => 'Serrano Basilio',
            'fech_nacimiento' => '2019-10-03', 'sexo' => 'masculino', 'num_celular' => '924883733', 'dni' => '70236495', 'direccion' => 'Avenida evitamiento sur 984', 'condicion' => 1
        ));
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
