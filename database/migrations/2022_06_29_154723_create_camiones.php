<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('camiones', function (Blueprint $table) {
            $table->id();
            $table->string('placa', 10)->unique();
            $table->string('modelo', 10);
            $table->integer('anno');
            $table->float('peso_soporte', 6, 2);
            $table->unsignedBigInteger('transportista_id');
            $table->unsignedBigInteger('marca_id');
            $table->unsignedBigInteger('tipo_camion_id');
            $table->foreign('transportista_id')->references('id')->on('users');
            $table->foreign('marca_id')->references('id')->on('marcas');
            $table->foreign('tipo_camion_id')->references('id')->on('tipos_camion');
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
        Schema::table('camiones', function(Blueprint $table){
            $table->dropForeign(['transportista_id']);
            $table->dropForeign(['marca_id']);
            $table->dropForeign(['tipo_camion_id']);
        });
        Schema::dropIfExists('camiones');
    }
};
