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
        Schema::create('purchased_mocks', function (Blueprint $table) {
            $table->id();
            $table->biginteger('candidate_log_id');
            $table->string('date');
            $table->string('payment_status');
            $table->integer('paid_fees');
            $table->integer('due_fees');
            $table->integer('total_fees');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchased_mocks');
    }
};
