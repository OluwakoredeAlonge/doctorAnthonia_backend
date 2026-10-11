<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            if (!Schema::hasColumn('books', 'price')) {
                $table->decimal('price', 10, 2)->nullable()->after('buy_link');
            }
            if (!Schema::hasColumn('books', 'featured')) {
                $table->boolean('featured')->default(false)->after('price');
            }
            if (!Schema::hasColumn('books', 'is_digital')) {
                $table->boolean('is_digital')->default(false)->after('featured');
            }
            if (!Schema::hasColumn('books', 'file_path')) {
                $table->string('file_path', 500)->nullable()->after('is_digital');
            }
        });
    }

    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn(['price', 'featured', 'is_digital', 'file_path']);
        });
    }
};
