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
        Schema::create('propuesta_viaje', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_viaje');
            $table->date('fecha_publicacion');
            $table->time('hora_publicacion');
            $table->float('peso_carga_total', 6, 2);
            $table->string('tipo_viaje', 20);
            $table->string('estado_oferta', 20);
            $table->string('observacion', 250);
            $table->unsignedBigInteger('origen_id');
            $table->unsignedBigInteger('destino_id');
            $table->unsignedBigInteger('id_empresa');
            $table->foreign('id_empresa')->references('id')->on('users');
            $table->foreign('origen_id')->references('id')->on('ciudades');
            $table->foreign('destino_id')->references('id')->on('ciudades');
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
        Schema::table('propuesta_viaje', function (Blueprint $table) {
            $table->dropForeign(['id_empresa']);
            $table->dropForeign(['origen_id']);
            $table->dropForeign(['destino_id']);
        });
        Schema::dropIfExists('propuesta_viaje');
    }
};
