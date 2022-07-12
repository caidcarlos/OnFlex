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
        Schema::create('gastos', function (Blueprint $table) {
            $table->id();
            $table->string('concepto', 90);
            $table->float('precio', 9, 2);
            $table->integer('cantidad');
            $table->unsignedBigInteger('viaje_id');
            $table->foreign('viaje_id')->references('id')->on('viaje');
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
        Schema::table('gastos', function (Blueprint $table){
            $table->dropForeign(['viaje_id']);
        });
        Schema::dropIfExists('gastos');
    }
};
