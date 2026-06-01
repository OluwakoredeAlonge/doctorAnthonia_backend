<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\SiteSetting;

class CoursePageController extends Controller
{
    private function baseSettings(): array
    {
        return SiteSetting::bulk([
            'doctor_name',
            'social_facebook', 'social_instagram', 'social_twitter',
            'social_linkedin', 'social_youtube', 'social_tiktok', 'social_spotify',
            'contact_phone', 'contact_email',
        ]);
    }

    public function index()
    {
        $courses  = Course::with('modules')->orderBy('sort_order')->orderBy('id')->get();
        $settings = $this->baseSettings();

        return view('courses', compact('courses', 'settings'));
    }

    public function show(Course $course)
    {
        $course->load('modules');
        $settings = $this->baseSettings();

        return view('course', compact('course', 'settings'));
    }
}
