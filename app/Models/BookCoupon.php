<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookCoupon extends Model
{
    protected $fillable = [
        'code', 'discount_percent', 'book_id', 'assigned_to',
        'max_uses', 'use_count', 'is_active', 'expires_at',
    ];

    protected $casts = [
        'is_active'  => 'boolean',
        'expires_at' => 'datetime',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function isValid(?int $bookId = null): bool
    {
        if (!$this->is_active) return false;
        if ($this->use_count >= $this->max_uses) return false;
        if ($this->expires_at && $this->expires_at->isPast()) return false;
        // If coupon is scoped to a specific book, it must match
        if ($this->book_id && $bookId && $this->book_id !== $bookId) return false;
        return true;
    }

    public function applyToPrice(float $price): float
    {
        return max(0, round($price * (1 - $this->discount_percent / 100), 2));
    }

    public function markUsed(): void
    {
        $this->increment('use_count');
    }
}
