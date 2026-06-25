<?php

namespace App\Http\Controllers;

use App\Models\BlogComment;
use App\Models\BlogLike;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogInteractionController extends Controller
{
    public function like(Request $request, BlogPost $blogPost)
    {
        abort_if($blogPost->status !== 'published', 404);

        $ip      = $request->ip();
        $existing = BlogLike::where('blog_post_id', $blogPost->id)
            ->where('ip_address', $ip)
            ->first();

        if ($existing) {
            $existing->delete();
            $liked = false;
        } else {
            BlogLike::create(['blog_post_id' => $blogPost->id, 'ip_address' => $ip]);
            $liked = true;
        }

        $count = BlogLike::where('blog_post_id', $blogPost->id)->count();

        return response()->json(['liked' => $liked, 'count' => $count]);
    }

    public function comment(Request $request, BlogPost $blogPost)
    {
        abort_if($blogPost->status !== 'published', 404);

        $validated = $request->validate([
            'name'  => 'required|string|max:100',
            'email' => 'required|email|max:200',
            'body'  => 'required|string|max:2000',
        ]);

        BlogComment::create([
            'blog_post_id' => $blogPost->id,
            'name'         => $validated['name'],
            'email'        => $validated['email'],
            'body'         => $validated['body'],
            'status'       => 'approved',
        ]);

        return back()->with('comment_posted', $validated['name']);
    }
}
