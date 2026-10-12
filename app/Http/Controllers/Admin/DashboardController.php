<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogComment;
use App\Models\BlogPost;
use App\Models\Book;
use App\Models\BookOrder;
use App\Models\ContactMessage;
use App\Models\Course;
use App\Models\HiddenPartnerCourse;
use App\Models\Organization;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\Testimonial;
use App\Services\PartnerCoursesClient;

class DashboardController extends Controller
{
    public function __construct(protected PartnerCoursesClient $partnerCourses) {}

    public function index()
    {
        $stats = [
            'posts'               => BlogPost::count(),
            'messages'            => ContactMessage::count(),
            'new_messages'        => ContactMessage::where('status', 'new')->count(),
            'testimonials'        => Testimonial::count(),
            'pending_testimonials'=> Testimonial::where('status', 'pending')->count(),
            'pending_comments'    => BlogComment::count(),
            'books'               => Book::count(),
            'orders'              => BookOrder::count(),
            'pending_orders'      => BookOrder::where('payment_status', 'pending')->count(),
            'courses'             => Course::count(),
            'organizations'       => Organization::count(),
        ];

        $recentMessages  = ContactMessage::latest()->take(5)->get();
        $recentPosts     = BlogPost::latest()->take(3)->get();
        $posts           = BlogPost::latest()->paginate(10);
        $testimonials    = Testimonial::latest()->get();
        $messages        = ContactMessage::latest()->get();
        $books           = Book::orderBy('sort_order')->orderBy('id')->get();
        $bookOrders      = BookOrder::with('book')->latest()->get();
        $courses         = Course::with('modules')->orderBy('sort_order')->orderBy('id')->get();
        $organizations   = Organization::orderBy('sort_order')->get();
        $services        = Service::orderBy('sort_order')->get();
        $settings        = SiteSetting::bulk([
            'doctor_name',
            'about_bio_1', 'about_bio_2', 'about_quote',
            'stat_books', 'stat_lives', 'stat_marriages', 'stat_addicts',
            'social_facebook', 'social_instagram', 'social_twitter', 'social_linkedin',
            'social_youtube', 'social_tiktok', 'social_spotify',
            'contact_phone', 'contact_email',
        ]);

        $comments = BlogComment::with('post')->latest()->get();
        $panel    = request('panel', 'dashboard');

        $partnerCourses    = $this->partnerCourses->allCourses();
        $partnerConfigured = $this->partnerCourses->isConfigured();
        $partnerFailed     = $this->partnerCourses->hasFailed();
        $hiddenPartnerSlugs = HiddenPartnerCourse::slugs();

        return view('admin.dashboard', compact(
            'stats', 'recentMessages', 'recentPosts',
            'posts', 'testimonials', 'messages', 'comments',
            'books', 'bookOrders', 'courses', 'organizations', 'services', 'settings', 'panel',
            'partnerCourses', 'partnerConfigured', 'partnerFailed', 'hiddenPartnerSlugs'
        ));
    }
}
