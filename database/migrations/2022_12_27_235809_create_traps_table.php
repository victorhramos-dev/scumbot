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
        Schema::create('traps', function (Blueprint $table) {
            $table->id();
            $table->string('trap_name');
            $table->bigInteger('armed_by');
            $table->string('armed_x');
            $table->string('armed_y');
            $table->string('armed_z');
            $table->datetime('armed_at');
            $table->bigInteger('triggered_by')->nullable();
            $table->string('triggered_x')->nullable();
            $table->string('triggered_y')->nullable();
            $table->string('triggered_z')->nullable();
            $table->datetime('triggered_at')->nullable();
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
        Schema::dropIfExists('traps');
    }
};
