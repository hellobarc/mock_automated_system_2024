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
        //unused
        Schema::create('offer_prices', function (Blueprint $table) {
            $table->id();
            $table->string('offer_description');
            $table->enum('offer_eligibility',['all', 'student']);
            $table->enum('offer_status',['active','inactive']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offer_prices');
    }
};
