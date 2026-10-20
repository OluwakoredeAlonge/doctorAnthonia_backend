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
            'title'             => 'required|string|max:255',
            'description'       => 'required|string',
            'category'          => 'required|string|max:100',
            'cover_gradient'    => 'required|string|max:20',
            'icon'              => 'required|string|max:50',
            'cover_image'       => 'nullable|string|max:500',
            'sort_order'        => 'nullable|integer',
            'digital_price'     => 'nullable|numeric|min:0',
            'hardcopy_price'    => 'nullable|numeric|min:0',
            'additional_info'   => 'nullable|string',
            'featured'          => 'nullable|boolean',
            'is_digital'        => 'nullable|boolean',
            'file_path'         => 'nullable|string|max:500',
            'watermark_enabled' => 'nullable|boolean',
        ]);

        $data['featured']          = $request->boolean('featured');
        $data['is_digital']        = $request->boolean('is_digital');
        $data['watermark_enabled'] = $request->boolean('watermark_enabled');
        // Only store prices when their checkbox was checked
        if (!$request->boolean('is_digital')) {
            $data['digital_price'] = null;
            $data['file_path']     = null;
        }
        if (!$request->has('hardcopy_price') || $request->input('hardcopy_price') === '') {
            $data['hardcopy_price'] = null;
        }

        Book::create($data);

        return redirect()->route('admin.dashboard', ['panel' => 'books'])
            ->with('success', 'Book added successfully.');
    }

    public function update(Request $request, Book $book)
    {
        $data = $request->validate([
            'title'             => 'required|string|max:255',
            'description'       => 'required|string',
            'category'          => 'required|string|max:100',
            'cover_gradient'    => 'required|string|max:20',
            'icon'              => 'required|string|max:50',
            'cover_image'       => 'nullable|string|max:500',
            'sort_order'        => 'nullable|integer',
            'digital_price'     => 'nullable|numeric|min:0',
            'hardcopy_price'    => 'nullable|numeric|min:0',
            'additional_info'   => 'nullable|string',
            'featured'          => 'nullable|boolean',
            'is_digital'        => 'nullable|boolean',
            'file_path'         => 'nullable|string|max:500',
            'watermark_enabled' => 'nullable|boolean',
        ]);

        $data['featured']          = $request->boolean('featured');
        $data['is_digital']        = $request->boolean('is_digital');
        $data['watermark_enabled'] = $request->boolean('watermark_enabled');
        if (!$request->boolean('is_digital')) {
            $data['digital_price'] = null;
        }
        if (!$request->has('hardcopy_price') || $request->input('hardcopy_price') === '') {
            $data['hardcopy_price'] = null;
        }

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
