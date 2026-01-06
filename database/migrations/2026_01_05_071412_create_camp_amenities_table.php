<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('camp_amenities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('camp_id')->constrained('camps')->cascadeOnDelete();
            $table->foreignId('amenity_id')->constrained('amenities')->cascadeOnDelete();
            $table->text('notes')->nullable(); // Additional notes about this amenity
            $table->timestamps();
            
            // Unique constraint to prevent duplicates
            $table->unique(['camp_id', 'amenity_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('camp_amenities');
    }
};