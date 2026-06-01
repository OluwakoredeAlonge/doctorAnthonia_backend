<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\SiteSetting;

class CoursePageController extends Controller
{
    public function show(Course $course)
    {
        $course->load('modules');

        $settings = SiteSetting::bulk([
            'doctor_name',
            'social_facebook', 'social_instagram', 'social_twitter',
            'social_linkedin', 'social_youtube', 'social_tiktok', 'social_spotify',
            'contact_phone', 'contact_email',
        ]);

        return view('course', compact('course', 'settings'));
    }
}
