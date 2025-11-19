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
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('digest_daily_enabled')->default(false);
            $table->boolean('digest_weekly_enabled')->default(false);
            $table->boolean('digest_monthly_enabled')->default(false);
            $table->boolean('digest_yearly_enabled')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
