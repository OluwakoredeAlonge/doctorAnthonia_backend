<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title', 'description', 'category',
        'cover_gradient', 'icon', 'buy_link', 'cover_image', 'sort_order',
        'price', 'featured', 'is_digital', 'file_path', 'watermark_enabled',
        'digital_price', 'hardcopy_price', 'additional_info',
    ];

    protected $casts = [
        'featured'          => 'boolean',
        'is_digital'        => 'boolean',
        'watermark_enabled' => 'boolean',
        'price'             => 'decimal:2',
        'digital_price'     => 'decimal:2',
        'hardcopy_price'    => 'decimal:2',
    ];

    /** Human-readable type label for display */
    public function getTypeLabelAttribute(): string
    {
        $hasDigital  = !is_null($this->digital_price);
        $hasHardcopy = !is_null($this->hardcopy_price);
        if ($hasDigital && $hasHardcopy) return 'Digital & Hardcopy';
        if ($hasDigital)  return 'Digital';
        if ($hasHardcopy) return 'Hardcopy';
        return 'Book';
    }

    public function orders()
    {
        return $this->hasMany(BookOrder::class);
    }
}
