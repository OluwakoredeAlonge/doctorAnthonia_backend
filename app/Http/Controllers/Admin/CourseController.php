<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseModule;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /* ── Courses ── */

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'cover_image' => 'nullable|string|max:500',
            'selar_url'   => 'nullable|string|max:500',
            'sort_order'  => 'nullable|integer',
        ]);

        $data['sort_order'] = $data['sort_order'] ?? Course::max('sort_order') + 1;

        Course::create($data);

        return redirect()->route('admin.dashboard', ['panel' => 'courses'])
            ->with('success', 'Course added. Now add modules to it.');
    }

    public function update(Request $request, Course $course)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'cover_image' => 'nullable|string|max:500',
            'selar_url'   => 'nullable|string|max:500',
        ]);

        $course->update($data);

        return redirect()->route('admin.dashboard', ['panel' => 'courses'])
            ->with('success', 'Course updated successfully.');
    }

    public function destroy(Course $course)
    {
        $course->delete(); // modules cascade via FK
        return redirect()->route('admin.dashboard', ['panel' => 'courses'])
            ->with('success', 'Course and all its modules deleted.');
    }

    /* ── Modules ── */

    public function storeModule(Request $request, Course $course)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'youtube_url'  => 'required|string|max:500',
            'workbook_url' => 'nullable|string|max:500',
            'sort_order'   => 'nullable|integer',
        ]);

        $data['course_id']  = $course->id;
        $data['sort_order'] = $data['sort_order'] ?? $course->modules()->max('sort_order') + 1;

        CourseModule::create($data);

        return redirect()->route('admin.dashboard', ['panel' => 'courses'])
            ->with('success', 'Module added successfully.');
    }

    public function updateModule(Request $request, CourseModule $module)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'youtube_url'  => 'required|string|max:500',
            'workbook_url' => 'nullable|string|max:500',
        ]);

        $module->update($data);

        return redirect()->route('admin.dashboard', ['panel' => 'courses'])
            ->with('success', 'Module updated successfully.');
    }

    public function destroyModule(CourseModule $module)
    {
        $module->delete();
        return redirect()->route('admin.dashboard', ['panel' => 'courses'])
            ->with('success', 'Module deleted.');
    }
}
