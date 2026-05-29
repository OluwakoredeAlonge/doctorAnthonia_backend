<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseModule extends Model
{
    protected $fillable = ['course_id', 'title', 'youtube_url', 'workbook_url', 'sort_order'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function getYoutubeIdAttribute(): ?string
    {
        $url = $this->youtube_url;
        if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/)([A-Za-z0-9_\-]{11})/', $url, $m)) {
            return $m[1];
        }
        return null;
    }
}
