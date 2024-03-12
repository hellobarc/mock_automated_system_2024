<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students_purhcased_mock_times', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('candidate_logs_id');
            $table->bigInteger('mock_dates_id');
            $table->bigInteger('speaking_time_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students_purhcased_mock_times');
    }
};
