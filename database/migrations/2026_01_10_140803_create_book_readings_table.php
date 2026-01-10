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
        Schema::create('book_readings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->date('started_at')->nullable();
            $table->date('finished_at')->nullable();
            $table->enum('format', ['physical', 'ebook', 'audiobook'])->nullable();
            $table->enum('status', ['reading', 'finished', 'abandoned'])->default('reading');
            $table->text('notes')->nullable();
            $table->timestamps();   
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_readings');
    }
};
