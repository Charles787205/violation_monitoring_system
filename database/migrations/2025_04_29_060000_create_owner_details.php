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
        Schema::create('owner_details', function (Blueprint $table) {
            $table->id();
            $table->string('license_number');
            $table->string('address');
            $table->foreignId('vehicle_id')->nullable()->references('id')->on('vehicles')->onDelete('set null'); // Fixed foreign key definition
            $table->string('license_image_link')->nullable();
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_approved')->default(false); // Add is_approved column
        });

        Schema::table('vehicles', function (Blueprint $table) {
            $table->string('photo_link')->nullable(); // Add vehicle photo link
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('owner_details');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_approved');
        });

        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropColumn('photo_link');
        });
    }
};