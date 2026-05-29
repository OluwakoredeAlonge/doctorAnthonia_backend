<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Make existing youtube_url / workbook_url columns nullable
        // (safe to do even if rows exist)
        Schema::table('courses', function (Blueprint $table) {
            $table->string('youtube_url', 500)->nullable()->change();
            $table->string('workbook_url', 500)->nullable()->change();
        });

        Schema::create('course_modules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('youtube_url', 500);
            $table->string('workbook_url', 500)->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_modules');
    }
};
