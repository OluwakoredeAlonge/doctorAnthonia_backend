<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookOrder;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function index()
    {
        $books    = Book::orderBy('sort_order')->orderBy('created_at')->get();
        $settings = SiteSetting::bulk([
            'doctor_name', 'social_facebook', 'social_instagram',
            'social_twitter', 'social_linkedin', 'social_youtube',
        ]);

        return view('books', compact('books', 'settings'));
    }

    public function order(Request $request, Book $book)
    {
        $data = $request->validate([
            'customer_name'    => 'required|string|max:255',
            'customer_email'   => 'required|email|max:255',
            'customer_phone'   => 'nullable|string|max:30',
            'customer_address' => 'nullable|string|max:500',
            'notes'            => 'nullable|string|max:1000',
        ]);

        BookOrder::create([
            'book_id'          => $book->id,
            'customer_name'    => $data['customer_name'],
            'customer_email'   => $data['customer_email'],
            'customer_phone'   => $data['customer_phone'] ?? null,
            'customer_address' => $data['customer_address'] ?? null,
            'amount'           => $book->price ?? 0,
            'payment_status'   => 'pending',
            'notes'            => $data['notes'] ?? null,
        ]);

        return response()->json(['success' => true, 'book' => $book->title]);
    }
}
