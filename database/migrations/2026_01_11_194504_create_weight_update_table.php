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
        Schema::create('weight_update', function (Blueprint $table) {
            $table->id();
            $table->decimal('weight', 8, 2);
            $table->decimal('difference', 8, 2)->nullable();
            $table->decimal('bmi', 5, 2)->nullable();
            $table->string('front_picture_url')->nullable();
            $table->string('side_picture_url')->nullable();
            $table->string('back_picture_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weight_update');
    }
};
