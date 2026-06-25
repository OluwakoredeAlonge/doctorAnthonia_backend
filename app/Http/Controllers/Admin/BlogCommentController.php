<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogComment;
use Illuminate\Http\Request;

class BlogCommentController extends Controller
{
    public function reply(Request $request, BlogComment $comment)
    {
        $validated = $request->validate([
            'body' => 'required|string|max:2000',
        ]);

        // Only one admin reply per comment
        if ($comment->replies()->exists()) {
            return back()->with('reply_error', 'A reply has already been posted for this comment.');
        }

        BlogComment::create([
            'blog_post_id' => $comment->blog_post_id,
            'parent_id'    => $comment->id,
            'name'         => 'Dr. Anthonia Soje',
            'email'        => null,
            'body'         => $validated['body'],
            'status'       => 'approved',
        ]);

        return back()->with('reply_posted', true);
    }

    public function destroy(BlogComment $comment)
    {
        $comment->delete();
        return back()->with('success', 'Comment deleted.');
    }
}
