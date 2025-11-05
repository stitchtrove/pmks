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
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('title')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->longText('content');
            $table->text('excerpt')->nullable();
            $table->enum('status', ['draft', 'private', 'published', 'archived'])->default('draft');
            $table->boolean('is_pinned')->default(false);
            $table->boolean('is_public')->default(false);
            $table->integer('word_count')->nullable();
            $table->integer('read_time')->nullable();
            $table->timestamp('last_reviewed_at')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
