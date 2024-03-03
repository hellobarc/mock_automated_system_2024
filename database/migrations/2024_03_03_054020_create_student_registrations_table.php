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
        Schema::create('student_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('student_id');
            $table->string('full_name');
            $table->string('email');
            $table->string('phone_number');
            $table->enum('purpose_of_ielts',['ac','gt']);
            $table->string('branch_name_for_mock');
            $table->string('date');
            $table->enum('student_source', ['inhouse','outside']);
            $table->integer('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_registrations');
    }
};
