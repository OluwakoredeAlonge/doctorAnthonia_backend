<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['title', 'description', 'selar_url', 'sort_order'];

    public function modules()
    {
        return $this->hasMany(CourseModule::class)->orderBy('sort_order');
    }
}
