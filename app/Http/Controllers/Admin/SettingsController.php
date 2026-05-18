<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'display_name' => 'nullable|string|max:100',
            'email'        => 'required|email|max:255',
            'phone'        => 'nullable|string|max:30',
        ]);

        Auth::user()->update($request->only('name', 'display_name', 'email', 'phone'));

        return redirect()->route('admin.dashboard', ['panel' => 'settings'])
            ->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|string|min:8|confirmed',
        ]);

        if (! Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        Auth::user()->update(['password' => Hash::make($request->password)]);

        return redirect()->route('admin.dashboard', ['panel' => 'settings'])
            ->with('success', 'Password updated successfully.');
    }

    public function updateSocial(Request $request)
    {
        $request->validate([
            'social_facebook'  => 'nullable|string|max:500',
            'social_instagram' => 'nullable|string|max:500',
            'social_twitter'   => 'nullable|string|max:500',
            'social_linkedin'  => 'nullable|string|max:500',
            'social_youtube'   => 'nullable|string|max:500',
            'social_tiktok'    => 'nullable|string|max:500',
            'contact_phone'    => 'nullable|string|max:50',
            'contact_email'    => 'nullable|email|max:200',
        ]);

        foreach ($request->only('social_facebook', 'social_instagram', 'social_twitter', 'social_linkedin', 'social_youtube', 'social_tiktok', 'contact_phone', 'contact_email') as $key => $value) {
            SiteSetting::set($key, $value ?? '');
        }

        return redirect()->route('admin.dashboard', ['panel' => 'settings'])
            ->with('success', 'Contact & social links updated.');
    }

    public function updateAbout(Request $request)
    {
        $request->validate([
            'about_bio_1' => 'required|string|max:1000',
            'about_bio_2' => 'required|string|max:1000',
            'about_quote' => 'required|string|max:500',
        ]);

        foreach ($request->only('about_bio_1', 'about_bio_2', 'about_quote') as $key => $value) {
            SiteSetting::set($key, $value);
        }

        return redirect()->route('admin.dashboard', ['panel' => 'about'])
            ->with('success', 'About section updated successfully.');
    }

    public function updateStats(Request $request)
    {
        $request->validate([
            'stat_books'     => 'required|integer|min:0',
            'stat_lives'     => 'required|integer|min:0',
            'stat_marriages' => 'required|integer|min:0',
            'stat_addicts'   => 'required|integer|min:0',
        ]);

        foreach ($request->only('stat_books', 'stat_lives', 'stat_marriages', 'stat_addicts') as $key => $value) {
            SiteSetting::set($key, (string) $value);
        }

        return redirect()->route('admin.dashboard', ['panel' => 'settings'])
            ->with('success', 'Hero statistics updated.');
    }
}
