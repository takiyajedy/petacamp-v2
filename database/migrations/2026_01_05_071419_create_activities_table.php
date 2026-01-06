<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            
            // Basic Information
            $table->string('title');
            $table->string('title_bm')->nullable();
            $table->text('description')->nullable();
            $table->text('description_bm')->nullable();
            
            // Activity Type
            $table->enum('type', ['one_off', 'recurring', 'fixed'])->default('one_off');
            
            // Schedule
            $table->json('schedule_json')->nullable(); // For recurring activities
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            
            // Status
            $table->enum('status', ['active', 'cancelled', 'completed'])->default('active');
            
            // Relations
            $table->foreignId('camp_id')->constrained('camps')->cascadeOnDelete();
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();
            
            $table->timestamps();
            
            // Indexes
            $table->index('camp_id');
            $table->index('status');
            $table->index('start_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};