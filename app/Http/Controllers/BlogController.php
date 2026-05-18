<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = BlogPost::where('status', 'published');

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $posts    = $query->latest('published_at')->paginate(9);
        $featured = BlogPost::where('status', 'published')->latest('published_at')->first();
        $categories = BlogPost::where('status', 'published')
            ->select('category')
            ->distinct()
            ->pluck('category');

        return view('blog.index', compact('posts', 'featured', 'categories'));
    }

    public function show(BlogPost $blogPost)
    {
        abort_if($blogPost->status !== 'published', 404);

        $blogPost->increment('views');

        $related = BlogPost::where('status', 'published')
            ->where('id', '!=', $blogPost->id)
            ->where('category', $blogPost->category)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('blog.show', compact('blogPost', 'related'));
    }
}
