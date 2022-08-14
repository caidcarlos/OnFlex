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
        Schema::table('empresa', function (Blueprint $table){
            $table->unsignedBigInteger('comercial_id');
            //$table->foreign('comercial_id')->references('id')->on('comerciales');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('empresa', function (Blueprint $table){
            //$table->dropForeign(['comercial_id']);
            $table->dropColumn('comercial_id');
        });
    }
};
