<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'title', 'description', 'youtube_url', 'workbook_url', 'sort_order',
    ];

    /**
     * Extract the YouTube video ID from a full URL or short URL.
     * Handles:
     *   https://www.youtube.com/watch?v=VIDEO_ID
     *   https://youtu.be/VIDEO_ID
     *   https://www.youtube.com/embed/VIDEO_ID
     */
    public function getYoutubeIdAttribute(): ?string
    {
        $url = $this->youtube_url;
        if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/)([A-Za-z0-9_\-]{11})/', $url, $m)) {
            return $m[1];
        }
        return null;
    }

    public function getEmbedUrlAttribute(): ?string
    {
        $id = $this->youtube_id;
        return $id ? "https://www.youtube.com/embed/{$id}" : null;
    }
}
