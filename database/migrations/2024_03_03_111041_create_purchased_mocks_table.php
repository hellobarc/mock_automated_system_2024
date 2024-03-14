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
            $table->string('package');
            $table->string('number_of_mocks_regular')->nullable();
            $table->string('total_amount_regular')->nullable();
            $table->string('payment_recieved_regular')->nullable();
            $table->string('free_number_of_mocks')->nullable();
            $table->string('free_current_batch_no')->nullable();
            $table->string('number_of_mocks_offered')->nullable();
            $table->string('number_of_mocks_offered_free')->nullable();
            $table->string('number_of_mocks_offered_paid')->nullable();
            $table->string('total_amount_offered')->nullable();
            $table->string('payment_recieved_offered')->nullable();
            $table->string('payment_status');
            $table->integer('paid_fees');
            $table->integer('due_fees')->nullable();
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
