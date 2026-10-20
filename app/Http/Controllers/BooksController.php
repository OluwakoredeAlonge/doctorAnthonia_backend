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
        $books    = Book::orderBy('sort_order')->orderBy('created_at')->paginate(12);
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
            'order_type'       => 'required|in:digital,hardcopy',
            'notes'            => 'nullable|string|max:1000',
        ]);

        $orderType = $data['order_type'];

        // Validate the chosen type is available on this book
        if ($orderType === 'digital'  && is_null($book->digital_price))  abort(422, 'Digital copy not available.');
        if ($orderType === 'hardcopy' && is_null($book->hardcopy_price)) abort(422, 'Hardcopy not available.');

        $amount = $orderType === 'digital' ? (float) $book->digital_price : (float) $book->hardcopy_price;

        $order = BookOrder::create([
            'book_id'          => $book->id,
            'order_type'       => $orderType,
            'customer_name'    => $data['customer_name'],
            'customer_email'   => $data['customer_email'],
            'customer_phone'   => $data['customer_phone'] ?? null,
            'customer_address' => $data['customer_address'] ?? null,
            'amount'           => $amount,
            'payment_status'   => 'pending',
            'notes'            => $data['notes'] ?? null,
        ]);

        // Auto-confirm free orders immediately
        if ($amount === 0.0) {
            $order->confirm();
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success'   => true,
                'reference' => $order->payment_reference,
                'order_url' => route('books.order.show', $order->payment_reference),
            ]);
        }

        return redirect()->route('books.order.show', $order->payment_reference);
    }
}
