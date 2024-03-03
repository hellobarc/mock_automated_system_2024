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
        Schema::create('candidate_infos', function (Blueprint $table) {
            $table->id();
            $table->biginteger('candidate_log_id');
            $table->string('branch_name_for_mock');
            $table->enum('purpose_of_ielts',['ac','gt']);
            $table->string('phone_number');
            $table->enum('student_source', ['inhouse','outside']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidate_infos');
    }
};
