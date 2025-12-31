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
        Schema::create('daily_actions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('action_id')->constrained()->cascadeOnDelete(); // the verb
            $table->nullableMorphs('subject'); // points to Thing or any future model
            $table->date('action_date'); // the date of the action
            $table->string('length')->nullable(); // 30 minutes
            $table->string('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_actions');
    }
};
