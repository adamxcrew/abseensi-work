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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->foreignId('employee_id')->constrained('employee_profiles')->onDelete('cascade')->onUpdate('cascade');
            $table->date('presence_date');
            $table->string('presence_status', 50);
            $table->string('presence_desc', 50);
            $table->time('clock_in');
            $table->time('clock_out');
            $table->string('location_in', 50);
            $table->string('location_out', 50);
            $table->string('presence_pict_in', 50);
            $table->string('presence_pict_out', 50);
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
        Schema::dropIfExists('attendances');
    }
};
