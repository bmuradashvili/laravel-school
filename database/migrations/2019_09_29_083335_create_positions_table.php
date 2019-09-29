<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('positions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
        });

        Schema::table('directors', function (Blueprint $table) {
            $table->foreign('position_id')->references('id')->on('positions')->onDelete('cascade');
        });

        Schema::table('teachers', function (Blueprint $table) {
            $table->foreign('position_id')->references('id')->on('positions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('directors', function (Blueprint $table) {
            $table->dropForeign(['position_id']);
        });

        Schema::table('teachers', function (Blueprint $table) {
            $table->dropForeign(['position_id']);
        });

        Schema::dropIfExists('positions');
    }
}
