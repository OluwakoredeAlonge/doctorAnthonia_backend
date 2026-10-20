<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('book_orders', function (Blueprint $table) {
            if (!Schema::hasColumn('book_orders', 'order_type')) {
                $table->string('order_type', 20)->default('digital')->after('book_id');
            }
            if (!Schema::hasColumn('book_orders', 'paid_claimed_at')) {
                $table->timestamp('paid_claimed_at')->nullable();
            }
            if (!Schema::hasColumn('book_orders', 'confirmed_at')) {
                $table->timestamp('confirmed_at')->nullable();
            }
            if (!Schema::hasColumn('book_orders', 'payment_reference')) {
                $table->string('payment_reference', 50)->nullable()->unique();
            }
        });

        // Expand the payment_status column to support the full status lifecycle
        DB::statement("ALTER TABLE book_orders MODIFY COLUMN payment_status VARCHAR(30) NOT NULL DEFAULT 'pending'");

        // Migrate existing 'paid' records to 'confirmed'
        DB::table('book_orders')->where('payment_status', 'paid')
            ->update(['payment_status' => 'confirmed', 'confirmed_at' => now()]);

        // Generate references for any existing orders that don't have one
        $orders = DB::table('book_orders')->whereNull('payment_reference')->get();
        foreach ($orders as $order) {
            DB::table('book_orders')->where('id', $order->id)->update([
                'payment_reference' => 'BOK-' . strtoupper(substr(md5($order->id . $order->created_at), 0, 10)),
            ]);
        }
    }

    public function down(): void
    {
        Schema::table('book_orders', function (Blueprint $table) {
            foreach (['order_type', 'paid_claimed_at', 'confirmed_at'] as $col) {
                if (Schema::hasColumn('book_orders', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
        DB::statement("ALTER TABLE book_orders MODIFY COLUMN payment_status ENUM('pending','paid') NOT NULL DEFAULT 'pending'");
    }
};
