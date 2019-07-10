<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rols', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 50);
            $table->string('descripcion', 250);
            $table->boolean('condicion')->default(1);
            $table->timestamps();
        });
        DB::table('rols')->insert(array('id' => '1', 'nombre' => 'Administrador', 'descripcion' => 'Administradores de área', 'condicion' => '1'));
        DB::table('rols')->insert(array('id' => '2', 'nombre' => 'Maestro', 'descripcion' => 'Maestro designada a cada aula', 'condicion' => '1'));
        DB::table('rols')->insert(array('id' => '3', 'nombre' => 'Padre', 'descripcion' => 'Padre de familia', 'condicion' => '1'));
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rols');
    }
}
