<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BookReaderController extends Controller
{
    public function show(Request $request, Book $book)
    {
        if (!$book->is_digital || !$book->file_path) {
            abort(404);
        }

        $error    = null;
        $verified = false;

        if ($request->isMethod('post')) {
            $email = strtolower(trim($request->input('email', '')));
            $order = BookOrder::where('book_id', $book->id)
                ->where('customer_email', $email)
                ->first();

            if ($order) {
                $token = $this->makeToken($book->id, $email);
                $url   = route('books.reader.read', ['book' => $book, 'token' => $token]) . '?' . http_build_query(['e' => $email]);
                return redirect($url);
            }

            $error = 'No order found for that email address. Please use the email you ordered with.';
        }

        return view('book-reader-verify', compact('book', 'error'));
    }

    public function read(Request $request, Book $book, string $token)
    {
        if (!$book->is_digital || !$book->file_path) {
            abort(404);
        }

        $expected = $this->makeToken($book->id, $request->query('e', ''));

        // Validate token carries a valid email in query string
        // Token is embedded in the redirect URL: /books/{book}/read/{token}?e={email}
        // We recompute from the email query param
        if (!hash_equals($expected, $token)) {
            abort(403, 'Invalid or expired access link.');
        }

        return view('book-reader', compact('book', 'token'));
    }

    public function stream(Request $request, Book $book, string $token)
    {
        if (!$book->is_digital || !$book->file_path) {
            abort(404);
        }

        $email    = $request->query('e', '');
        $expected = $this->makeToken($book->id, $email);

        if (!hash_equals($expected, $token)) {
            abort(403);
        }

        try {
            $response = Http::timeout(30)->get($book->file_path);
            if (!$response->successful()) {
                abort(502, 'Could not fetch the book file.');
            }

            return response($response->body(), 200, [
                'Content-Type'              => 'application/pdf',
                'Content-Disposition'       => 'inline; filename="book.pdf"',
                'X-Content-Type-Options'    => 'nosniff',
                'Cache-Control'             => 'private, no-store',
                'X-Frame-Options'           => 'SAMEORIGIN',
            ]);
        } catch (\Exception $e) {
            abort(502, 'Could not load the book file.');
        }
    }

    private function makeToken(int $bookId, string $email): string
    {
        return hash_hmac('sha256', $bookId . '|' . strtolower(trim($email)), config('app.key'));
    }
}
