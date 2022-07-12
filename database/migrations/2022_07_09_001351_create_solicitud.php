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
        Schema::create('solicitud', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('propuesta_id');
            $table->unsignedBigInteger('transportista_id');
            $table->string('estado');
            $table->foreign('propuesta_id')->references('id')->on('propuesta_viaje');
            $table->foreign('transportista_id')->references('id')->on('users');
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
        Schema::table('solicitud', function(Blueprint $table){
            $table->dropForeign(['propuesta_id']);
            $table->dropForeign(['transportista_id']);
        });
        Schema::dropIfExists('solicitud');
    }
};
