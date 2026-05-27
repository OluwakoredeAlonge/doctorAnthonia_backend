<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'nullable|string|max:1000',
            'youtube_url'  => 'required|string|max:500',
            'workbook_url' => 'nullable|string|max:500',
            'sort_order'   => 'nullable|integer',
        ]);

        Course::create($data);

        return redirect()->route('admin.dashboard', ['panel' => 'courses'])
            ->with('success', 'Course added successfully.');
    }

    public function update(Request $request, Course $course)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'nullable|string|max:1000',
            'youtube_url'  => 'required|string|max:500',
            'workbook_url' => 'nullable|string|max:500',
            'sort_order'   => 'nullable|integer',
        ]);

        $course->update($data);

        return redirect()->route('admin.dashboard', ['panel' => 'courses'])
            ->with('success', 'Course updated successfully.');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('admin.dashboard', ['panel' => 'courses'])
            ->with('success', 'Course deleted.');
    }
}
