<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'           => 'required|string|max:255',
            'description'     => 'required|string|max:500',
            'category'        => 'required|string|max:100',
            'cover_gradient'  => 'required|string|max:20',
            'icon'            => 'required|string|max:50',
            'buy_link'        => 'nullable|url|max:500',
            'sort_order'      => 'nullable|integer',
        ]);

        Book::create($data);

        return redirect()->route('admin.dashboard', ['panel' => 'books'])
            ->with('success', 'Book added successfully.');
    }

    public function update(Request $request, Book $book)
    {
        $data = $request->validate([
            'title'           => 'required|string|max:255',
            'description'     => 'required|string|max:500',
            'category'        => 'required|string|max:100',
            'cover_gradient'  => 'required|string|max:20',
            'icon'            => 'required|string|max:50',
            'buy_link'        => 'nullable|url|max:500',
            'sort_order'      => 'nullable|integer',
        ]);

        $book->update($data);

        return redirect()->route('admin.dashboard', ['panel' => 'books'])
            ->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('admin.dashboard', ['panel' => 'books'])
            ->with('success', 'Book deleted.');
    }
}
