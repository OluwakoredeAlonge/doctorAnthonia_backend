<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogPostController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'           => 'required|string|max:255',
            'category'        => 'required|string|max:100',
            'status'          => 'required|in:draft,published',
            'excerpt'         => 'nullable|string|max:500',
            'content'         => 'required|string',
            'featured_image'  => 'nullable|url|max:500',
            'read_time'       => 'nullable|integer|min:1|max:120',
        ]);

        $data['slug']         = Str::slug($data['title']);
        $data['published_at'] = $data['status'] === 'published' ? now() : null;
        $data['read_time']    = $data['read_time'] ?? 5;

        BlogPost::create($data);

        return redirect()->route('admin.dashboard', ['panel' => 'posts'])
            ->with('success', 'Blog post created successfully.');
    }

    public function update(Request $request, BlogPost $blogPost)
    {
        $data = $request->validate([
            'title'           => 'required|string|max:255',
            'category'        => 'required|string|max:100',
            'status'          => 'required|in:draft,published',
            'excerpt'         => 'nullable|string|max:500',
            'content'         => 'required|string',
            'featured_image'  => 'nullable|url|max:500',
            'read_time'       => 'nullable|integer|min:1|max:120',
        ]);

        if ($data['status'] === 'published' && ! $blogPost->published_at) {
            $data['published_at'] = now();
        }

        $blogPost->update($data);

        return redirect()->route('admin.dashboard', ['panel' => 'posts'])
            ->with('success', 'Blog post updated successfully.');
    }

    public function destroy(BlogPost $blogPost)
    {
        $blogPost->delete();
        return redirect()->route('admin.dashboard', ['panel' => 'posts'])
            ->with('success', 'Blog post deleted.');
    }
}
