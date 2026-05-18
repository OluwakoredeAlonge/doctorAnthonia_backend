<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Book;
use App\Models\ContactMessage;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\Testimonial;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'posts'            => BlogPost::count(),
            'messages'         => ContactMessage::count(),
            'new_messages'     => ContactMessage::where('status', 'new')->count(),
            'testimonials'     => Testimonial::count(),
            'pending_testimonials' => Testimonial::where('status', 'pending')->count(),
            'books'            => Book::count(),
        ];

        $recentMessages  = ContactMessage::latest()->take(5)->get();
        $recentPosts     = BlogPost::latest()->take(3)->get();
        $posts           = BlogPost::latest()->paginate(10);
        $testimonials    = Testimonial::latest()->get();
        $messages        = ContactMessage::latest()->get();
        $books           = Book::orderBy('sort_order')->get();
        $services        = Service::orderBy('sort_order')->get();
        $settings        = SiteSetting::bulk([
            'about_bio_1', 'about_bio_2', 'about_quote',
            'stat_books', 'stat_lives', 'stat_marriages', 'stat_addicts',
            'social_facebook', 'social_instagram', 'social_twitter', 'social_linkedin',
            'social_youtube', 'social_tiktok',
            'contact_phone', 'contact_email',
        ]);

        $panel = request('panel', 'dashboard');

        return view('admin.dashboard', compact(
            'stats', 'recentMessages', 'recentPosts',
            'posts', 'testimonials', 'messages',
            'books', 'services', 'settings', 'panel'
        ));
    }
}
