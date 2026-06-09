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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('status', ['pending', 'in_progress', 'resolved'])->default('pending');
            $table->string('category')->nullable();
            $table->string('location')->nullable();
            $table->string('location_metadata')->nullable();
            $table->text('description');
            $table->text('ai_report')->nullable();
            $table->text('recommended_action')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('image')->nullable();
            $table->string('priority')->nullable();
            $table->text('user_comments')->nullable();
            $table->text('solving_process')->nullable();
            $table->text('quotation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
