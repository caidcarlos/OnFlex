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
        Schema::create('pago_manual', function (Blueprint $table) {
            $table->id();
            $table->string('referencia', 20);
            $table->date('fecha_pago');
            $table->double('monto', 8, 2)->nullable();
            $table->boolean('status_pago');//para controlar si ha sido revisado el pago o no
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');
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
        Schema::table('pago_manual', function(Blueprint $table){
            $table->dropForeign(['id_user']);
        });
        Schema::dropIfExists('pago_manual');
    }
};
