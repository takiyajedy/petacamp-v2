<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('camps', function (Blueprint $table) {
            $table->id();
            
            // Basic Information
            $table->string('name');
            $table->string('name_bm')->nullable();
            $table->text('address');
            $table->string('state');
            $table->string('city')->nullable();
            $table->string('postcode')->nullable();
            
            // Geolocation
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            
            // Descriptions
            $table->text('description')->nullable();
            $table->text('description_bm')->nullable();
            
            // Contact Information
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            
            // Operating Hours
            $table->json('operating_hours')->nullable();
            
            // Pricing
            $table->decimal('price_per_night', 8, 2)->nullable();
            $table->decimal('price_per_person', 8, 2)->nullable();
            $table->text('pricing_notes')->nullable();
            
            // Capacity
            $table->integer('max_capacity')->nullable();
            $table->integer('tent_sites')->nullable();
            
            // Media
            $table->string('image')->nullable();
            $table->json('gallery')->nullable();
            
            // Status and Moderation
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->text('rejection_reason')->nullable();
            
            // Metadata
            $table->integer('views_count')->default(0);
            $table->boolean('is_featured')->default(false);
            
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes
            $table->index('state');
            $table->index('status');
            $table->index(['latitude', 'longitude']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('camps');
    }
};