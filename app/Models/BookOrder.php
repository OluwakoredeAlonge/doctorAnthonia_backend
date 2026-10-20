<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BookOrder extends Model
{
    protected $fillable = [
        'book_id', 'order_type',
        'customer_name', 'customer_email', 'customer_phone', 'customer_address',
        'amount', 'payment_reference', 'payment_status', 'notes',
        'paid_claimed_at', 'confirmed_at',
    ];

    protected $casts = [
        'paid_claimed_at' => 'datetime',
        'confirmed_at'    => 'datetime',
        'amount'          => 'decimal:2',
    ];

    protected static function booted(): void
    {
        static::creating(function (BookOrder $order) {
            if (empty($order->payment_reference)) {
                do {
                    $ref = 'BOK-' . strtoupper(Str::random(10));
                } while (self::where('payment_reference', $ref)->exists());
                $order->payment_reference = $ref;
            }
        });
    }

    public function markPaidClaimed(): void
    {
        $this->update([
            'payment_status'  => 'awaiting_confirmation',
            'paid_claimed_at' => now(),
        ]);
    }

    public function confirm(): void
    {
        $this->update([
            'payment_status' => 'confirmed',
            'confirmed_at'   => now(),
        ]);
    }

    public function reject(): void
    {
        $this->update(['payment_status' => 'rejected']);
    }

    public function isFree(): bool
    {
        return (float) $this->amount === 0.0;
    }

    public function hasDigitalAccess(): bool
    {
        return $this->payment_status === 'confirmed'
            && $this->order_type === 'digital';
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
