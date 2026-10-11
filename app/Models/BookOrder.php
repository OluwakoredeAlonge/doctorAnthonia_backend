<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookOrder extends Model
{
    protected $fillable = [
        'book_id', 'customer_name', 'customer_email', 'customer_phone',
        'customer_address', 'amount', 'payment_reference', 'payment_status', 'notes',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
