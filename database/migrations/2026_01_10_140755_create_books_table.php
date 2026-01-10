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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('authors')->nullable();
            $table->string('isbn')->unique();
            $table->date('publish_date')->nullable();
            $table->string('cover_url')->nullable();
            $table->integer('number_of_pages')->nullable();
            $table->float('rating')->nullable();
            $table->text('description')->nullable();
            $table->string('publisher')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
