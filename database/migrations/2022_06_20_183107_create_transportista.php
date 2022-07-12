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
        Schema::create('transportista', function (Blueprint $table) {
            $table->id();
            $table->string('apellido', 50);
            $table->string('cedula', 15)->unique();
            $table->string('num_pase', 200);
            $table->float('peso', 5, 2);
            $table->float('estatura', 3, 2);
            $table->unsignedBigInteger('usuario_id');
            $table->foreign('usuario_id')->references('id')->on('users');
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
        Schema::table('transportista', function (Blueprint $table){
            $table->dropForeign(['usuario_id']);
        });
        Schema::dropIfExists('transportista');
    }
};
