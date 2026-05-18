<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordResetOtp;
use App\Models\User;
use App\Services\TwilioService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    public function showForm()
    {
        return view('auth.forgot-password');
    }

    public function showResetForm()
    {
        $phone = session('otp_phone');
        if (! $phone) {
            return redirect()->route('password.request');
        }
        return view('auth.reset-password', compact('phone'));
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
        ]);

        $user = User::where('phone', $request->phone)->first();

        if (! $user) {
            return back()->withErrors(['phone' => 'No account found with that phone number.']);
        }

        $twilio = app(TwilioService::class);
        $otp    = $twilio->sendOtp($request->phone);

        // Delete any previous OTP for this number and save the new one
        PasswordResetOtp::where('phone', $request->phone)->delete();
        PasswordResetOtp::create([
            'phone'      => $request->phone,
            'otp'        => $otp,
            'expires_at' => now()->addMinutes(10),
        ]);

        return redirect()->route('password.reset.form')
            ->with('otp_phone', $request->phone)
            ->with('otp_sent', true);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'phone'    => 'required|string',
            'otp'      => 'required|string|size:6',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $record = PasswordResetOtp::where('phone', $request->phone)
            ->where('otp', $request->otp)
            ->first();

        if (! $record || $record->isExpired()) {
            return redirect()->route('password.reset.form')
                ->with('otp_phone', $request->phone)
                ->withErrors(['otp' => 'Invalid or expired OTP. Please try again.']);
        }

        $user = User::where('phone', $request->phone)->first();

        if (! $user) {
            return redirect()->route('password.reset.form')
                ->with('otp_phone', $request->phone)
                ->withErrors(['phone' => 'No account found.']);
        }

        $user->update(['password' => Hash::make($request->password)]);
        $record->delete();

        return redirect()->route('login')
            ->with('status', 'Password reset successfully. Please log in.');
    }
}
