<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\ContactMessage;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\Testimonial;
use App\Services\TelegramService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $books        = Book::orderBy('sort_order')->get();
        $services     = Service::orderBy('sort_order')->get();
        $testimonials = Testimonial::where('status', 'approved')->latest()->get();
        $settings     = SiteSetting::bulk([
            'about_bio_1', 'about_bio_2', 'about_quote',
            'stat_books', 'stat_lives', 'stat_marriages', 'stat_addicts',
            'social_facebook', 'social_instagram', 'social_twitter', 'social_linkedin',
            'social_youtube', 'social_tiktok',
            'contact_phone', 'contact_email',
        ]);

        return view('home', compact('books', 'services', 'testimonials', 'settings'));
    }

    public function contact(Request $request)
    {
        $validated = $request->validate([
            'name'               => 'required|string|max:200',
            'email'              => 'required|email|max:200',
            'phone'              => 'nullable|string|max:30',
            'preferred_feedback' => 'nullable|string|max:100',
            'service'            => 'nullable|string|max:100',
            'message'            => 'required|string|max:3000',
        ]);

        $msg = ContactMessage::create([
            'name'               => $validated['name'],
            'email'              => $validated['email'],
            'phone'              => $validated['phone'] ?? null,
            'preferred_feedback' => $validated['preferred_feedback'] ?? null,
            'service'            => $validated['service'] ?? null,
            'message'            => $validated['message'],
            'status'             => 'new',
        ]);

        app(TelegramService::class)->notifyNewMessage(
            $msg->name,
            $msg->email,
            $msg->phone ?? '',
            $msg->service ?? '',
            $msg->message
        );

        return back()->with('contact_success', true);
    }
}
