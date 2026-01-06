<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            
            // Actor
            $table->foreignId('actor_id')->nullable()->constrained('users')->nullOnDelete();
            
            // Action
            $table->string('action'); // e.g., 'camp.created', 'submission.approved'
            
            // Entity
            $table->string('entity_type'); // e.g., 'Camp', 'Submission'
            $table->unsignedBigInteger('entity_id')->nullable();
            
            // Data
            $table->json('before')->nullable(); // State before change
            $table->json('after')->nullable(); // State after change
            
            // Context
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            
            $table->timestamp('timestamp')->useCurrent();
            
            // Indexes
            $table->index('actor_id');
            $table->index(['entity_type', 'entity_id']);
            $table->index('action');
            $table->index('timestamp');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};