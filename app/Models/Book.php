<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title', 'description', 'category',
        'cover_gradient', 'icon', 'buy_link', 'cover_image', 'sort_order',
        'price', 'featured', 'is_digital', 'file_path', 'watermark_enabled',
    ];

    protected $casts = [
        'featured'          => 'boolean',
        'is_digital'        => 'boolean',
        'watermark_enabled' => 'boolean',
        'price'             => 'decimal:2',
    ];

    public function orders()
    {
        return $this->hasMany(BookOrder::class);
    }
}
