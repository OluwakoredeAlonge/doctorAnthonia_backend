<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Course;

class SitemapController extends Controller
{
    public function index()
    {
        $posts   = BlogPost::where('status', 'published')->latest('published_at')->get(['slug', 'updated_at']);
        $courses = Course::orderBy('sort_order')->get(['id', 'updated_at']);

        $content = '<?xml version="1.0" encoding="UTF-8"?>' . "\n"
            . view('sitemap', compact('posts', 'courses'))->render();

        return response($content, 200)->header('Content-Type', 'application/xml');
    }
}
