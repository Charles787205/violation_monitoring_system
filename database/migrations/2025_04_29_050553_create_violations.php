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
        Schema::create('violations', function (Blueprint $table) {
            $table->id();
            $table->string('license_plate'); // License plate (not a foreign key)
            $table->string('violation_type'); // Type of violation (e.g., speeding, parking)
            $table->decimal('amount', 10, 2); // Fine amount
            $table->enum('status', ['pending', 'paid'])->default('pending'); // Payment status
            $table->timestamp('paid_at')->nullable(); // Payment timestamp
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('violations');
    }
};
