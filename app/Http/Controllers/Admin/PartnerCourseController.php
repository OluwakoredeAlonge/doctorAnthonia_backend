<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HiddenPartnerCourse;
use App\Services\PartnerCoursesClient;

class PartnerCourseController extends Controller
{
    /** Flip a pulled course between shown and hidden on the public Courses page. */
    public function toggle(string $slug)
    {
        $hidden = HiddenPartnerCourse::where('slug', $slug)->first();

        if ($hidden) {
            $hidden->delete();
            $message = 'Course is now shown on your Courses page.';
        } else {
            HiddenPartnerCourse::create(['slug' => $slug]);
            $message = 'Course is now hidden from your Courses page.';
        }

        return $this->backToPanel($message);
    }

    /** Re-fetch the catalogue from Heirs right now instead of waiting for the cache to expire. */
    public function refresh(PartnerCoursesClient $courses)
    {
        $courses->refresh();

        return $this->backToPanel('Course list refreshed from Heirs.');
    }

    private function backToPanel(string $message)
    {
        return redirect()->route('admin.dashboard', ['panel' => 'courses'])->with('success', $message);
    }
}
