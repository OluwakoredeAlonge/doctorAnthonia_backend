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
        Schema::table('courses', function (Blueprint $table) {
            if (!Schema::hasColumn('courses', 'cover_image')) {
                $table->string('cover_image', 500)->nullable()->after('description');
            }
            if (!Schema::hasColumn('courses', 'selar_url')) {
                $table->string('selar_url', 500)->nullable()->after('cover_image');
            }
        });
    }

    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $cols = array_filter(['cover_image', 'selar_url'], fn($c) => Schema::hasColumn('courses', $c));
            if ($cols) $table->dropColumn(array_values($cols));
        });
    }
};
