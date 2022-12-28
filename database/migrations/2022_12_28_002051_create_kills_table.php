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
        Schema::create('kills', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('killer_steam_id');
            $table->string('killer_name');
            $table->string('killer_x');
            $table->string('killer_y');
            $table->string('killer_z');
            $table->bigInteger('victim_steam_id');
            $table->string('victim_name');
            $table->string('victim_x');
            $table->string('victim_y');
            $table->string('victim_z');
            $table->string('weapon');
            $table->dateTime('date');
            $table->string('timeofday');
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
        Schema::dropIfExists('kills');
    }
};
