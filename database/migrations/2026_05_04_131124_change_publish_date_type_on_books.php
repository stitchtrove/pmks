<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->unsignedSmallInteger('published_year')->nullable()->after('isbn');
        });

        DB::statement("
            UPDATE books 
            SET published_year = YEAR(publish_date)
            WHERE publish_date IS NOT NULL
        ");

        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn('publish_date');
        });
    }

    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->date('publish_date')->nullable()->after('isbn');
        });

        DB::statement("
            UPDATE books 
            SET publish_date = CONCAT(published_year, '-01-01')
            WHERE published_year IS NOT NULL
        ");

        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn('published_year');
        });
    }
};
