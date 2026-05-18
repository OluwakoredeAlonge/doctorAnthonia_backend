<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title', 'description', 'category',
        'cover_gradient', 'icon', 'buy_link', 'sort_order',
    ];
}
