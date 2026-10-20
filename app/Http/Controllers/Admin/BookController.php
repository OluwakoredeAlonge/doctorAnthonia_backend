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
            'title'          => 'required|string|max:255',
            'description'    => 'required|string',
            'category'       => 'required|string|max:100',
            'cover_gradient' => 'required|string|max:20',
            'icon'           => 'required|string|max:50',
            'buy_link'       => 'nullable|string|max:500',
            'cover_image'    => 'nullable|string|max:500',
            'sort_order'     => 'nullable|integer',
            'price'          => 'nullable|numeric|min:0',
            'featured'       => 'nullable|boolean',
            'is_digital'         => 'nullable|boolean',
            'file_path'          => 'nullable|string|max:500',
            'watermark_enabled'  => 'nullable|boolean',
        ]);

        $data['featured']          = $request->boolean('featured');
        $data['is_digital']        = $request->boolean('is_digital');
        $data['watermark_enabled'] = $request->boolean('watermark_enabled');

        Book::create($data);

        return redirect()->route('admin.dashboard', ['panel' => 'books'])
            ->with('success', 'Book added successfully.');
    }

    public function update(Request $request, Book $book)
    {
        $data = $request->validate([
            'title'          => 'required|string|max:255',
            'description'    => 'required|string',
            'category'       => 'required|string|max:100',
            'cover_gradient' => 'required|string|max:20',
            'icon'           => 'required|string|max:50',
            'buy_link'       => 'nullable|string|max:500',
            'cover_image'    => 'nullable|string|max:500',
            'sort_order'     => 'nullable|integer',
            'price'          => 'nullable|numeric|min:0',
            'featured'       => 'nullable|boolean',
            'is_digital'         => 'nullable|boolean',
            'file_path'          => 'nullable|string|max:500',
            'watermark_enabled'  => 'nullable|boolean',
        ]);

        $data['featured']          = $request->boolean('featured');
        $data['is_digital']        = $request->boolean('is_digital');
        $data['watermark_enabled'] = $request->boolean('watermark_enabled');

        $book->update($data);

        return redirect()->route('admin.dashboard', ['panel' => 'books'])
            ->with('success', 'Book updated successfully.');
    }

    public function toggleFeatured(Book $book)
    {
        $book->update(['featured' => !$book->featured]);
        return response()->json(['featured' => $book->fresh()->featured]);
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('admin.dashboard', ['panel' => 'books'])
            ->with('success', 'Book deleted.');
    }
}
