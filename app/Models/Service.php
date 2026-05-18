<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'title', 'description', 'color', 'icon', 'is_featured', 'sort_order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];
}
