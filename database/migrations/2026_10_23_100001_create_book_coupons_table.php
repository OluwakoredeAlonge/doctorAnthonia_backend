<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('book_coupons')) return;

        Schema::create('book_coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50)->unique();
            $table->unsignedTinyInteger('discount_percent'); // 25, 50, or 100
            $table->foreignId('book_id')->nullable()->constrained('books')->nullOnDelete();
            $table->string('assigned_to', 255)->nullable(); // doctor's reference (name/email)
            $table->unsignedInteger('max_uses')->default(1);
            $table->unsignedInteger('use_count')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('book_coupons');
    }
};
