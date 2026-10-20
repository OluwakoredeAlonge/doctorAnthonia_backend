<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            if (!Schema::hasColumn('books', 'digital_price')) {
                $table->decimal('digital_price', 10, 2)->nullable()->after('price');
            }
            if (!Schema::hasColumn('books', 'hardcopy_price')) {
                $table->decimal('hardcopy_price', 10, 2)->nullable()->after('digital_price');
            }
            if (!Schema::hasColumn('books', 'additional_info')) {
                $table->text('additional_info')->nullable()->after('hardcopy_price');
            }
        });

        // Migrate existing price data into the new columns
        DB::table('books')->whereNotNull('price')->where('is_digital', true)
            ->update(['digital_price' => DB::raw('price')]);

        DB::table('books')->whereNotNull('price')->where('is_digital', false)
            ->update(['hardcopy_price' => DB::raw('price')]);
    }

    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            foreach (['digital_price', 'hardcopy_price', 'additional_info'] as $col) {
                if (Schema::hasColumn('books', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
