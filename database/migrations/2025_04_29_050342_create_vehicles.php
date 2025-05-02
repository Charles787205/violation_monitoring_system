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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('license_plate')->unique(); // License plate
            $table->string('make'); // Vehicle make (e.g., Toyota)
            $table->string('model'); // Vehicle model (e.g., Corolla)
            $table->year('year'); // Year of manufacture
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade'); // Linked to a client
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
