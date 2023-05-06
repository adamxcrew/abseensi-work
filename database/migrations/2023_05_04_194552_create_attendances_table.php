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
            $table->string('presence_desc')->nullable();
            $table->time('clock_in');
            $table->time('clock_out')->nullable();
            $table->string('location_in');
            $table->string('location_out')->nullable();
            $table->string('presence_pict_in');
            $table->string('presence_pict_out')->nullable();
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
