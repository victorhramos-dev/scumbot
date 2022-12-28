<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_logins', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('steam_id');
            $table->string('type');
            $table->string('ip');
            $table->string('x');
            $table->string('y');
            $table->string('z');
            $table->dateTime('date');
            $table->timestamps();
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('players_login');
    }
};
