<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:100',
            'service' => 'required|string|max:100',
            'rating'  => 'required|integer|min:1|max:5',
            'content' => 'required|string|max:1000',
        ]);

        Testimonial::create([
            'name'    => $request->name,
            'service' => $request->service,
            'rating'  => $request->rating,
            'content' => $request->content,
            'status'  => 'approved',
        ]);

        return redirect()->route('admin.dashboard', ['panel' => 'testimonials'])
            ->with('success', 'Testimonial added successfully.');
    }

    public function approve(Testimonial $testimonial)
    {
        $testimonial->update(['status' => 'approved']);
        return response()->json(['success' => true, 'status' => 'approved']);
    }

    public function reject(Testimonial $testimonial)
    {
        $testimonial->update(['status' => 'rejected']);
        return response()->json(['success' => true, 'status' => 'rejected']);
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return response()->json(['success' => true]);
    }
}
