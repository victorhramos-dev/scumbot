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
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('steam_id')->unique();
            $table->string('last_ip')->nullable();
            $table->tinyInteger('is_admin')->default(0);
            $table->float('balance')->default(0);
            $table->string('steam_name')->nullable();
            $table->string('steam_avatar')->nullable();
            $table->integer('steam_since')->nullable();
            $table->longText('steam_data')->nullable();
            $table->string('discord_id')->nullable();
            $table->string('discord_name')->nullable();
            $table->string('discord_avatar')->nullable();
            $table->longText('discord_data')->nullable();
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
        Schema::dropIfExists('players');
    }
};
