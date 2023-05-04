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
        Schema::create('time_off_settings', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_timeoff');
            $table->string('description_timeoff');
            $table->string('code_timeoff');
            $table->integer('durasi_timeoff');
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
        Schema::dropIfExists('time_off_settings');
    }
};
