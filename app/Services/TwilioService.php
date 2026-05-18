<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TwilioService
{
    private string $accountSid;
    private string $authToken;
    private string $whatsappFrom;
    private string $smsFrom;

    public function __construct()
    {
        $this->accountSid   = config('twilio.account_sid');
        $this->authToken    = config('twilio.auth_token');
        $this->whatsappFrom = config('twilio.whatsapp_from');   // e.g. whatsapp:+14155238886
        $this->smsFrom      = config('twilio.phone_number');    // regular SMS number (optional)
    }

    /**
     * Send a WhatsApp message via Twilio.
     * Automatically prepends "whatsapp:" to $to if not already present.
     */
    public function sendWhatsApp(string $to, string $message): bool
    {
        if (empty($this->accountSid) || empty($this->authToken) || empty($this->whatsappFrom)) {
            Log::error('Twilio WhatsApp not configured — check TWILIO_SID, TWILIO_AUTH_TOKEN, TWILIO_WHATSAPP_FROM in .env');
            return false;
        }

        // Ensure E.164 "whatsapp:" prefix on destination
        $to = $this->toWhatsAppNumber($to);

        try {
            $response = Http::withBasicAuth($this->accountSid, $this->authToken)
                ->asForm()
                ->post("https://api.twilio.com/2010-04-01/Accounts/{$this->accountSid}/Messages.json", [
                    'From' => $this->whatsappFrom,
                    'To'   => $to,
                    'Body' => $message,
                ]);

            if (! $response->successful()) {
                Log::error('Twilio WhatsApp failed: ' . $response->body());
                return false;
            }

            Log::info("Twilio WhatsApp sent to {$to}");
            return true;

        } catch (\Exception $e) {
            Log::error('Twilio WhatsApp exception: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Send a plain SMS (only works if TWILIO_PHONE_NUMBER is set).
     */
    public function sendSms(string $to, string $message): bool
    {
        if (empty($this->accountSid) || empty($this->authToken) || empty($this->smsFrom)) {
            Log::error('Twilio SMS not configured — TWILIO_PHONE_NUMBER is empty');
            return false;
        }

        try {
            $response = Http::withBasicAuth($this->accountSid, $this->authToken)
                ->asForm()
                ->post("https://api.twilio.com/2010-04-01/Accounts/{$this->accountSid}/Messages.json", [
                    'From' => $this->smsFrom,
                    'To'   => $to,
                    'Body' => $message,
                ]);

            return $response->successful();
        } catch (\Exception $e) {
            Log::error('Twilio SMS failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Generate a 6-digit OTP, send it via WhatsApp, and return the OTP string.
     */
    public function sendOtp(string $phone): string
    {
        $otp = (string) random_int(100000, 999999);

        $sent = $this->sendWhatsApp(
            $phone,
            "🔐 *Dr. Soje Admin — Password Reset*\n\nYour one-time password is: *{$otp}*\n\nThis OTP expires in 10 minutes. Do not share it with anyone."
        );

        if (! $sent) {
            // Log the OTP for emergency recovery (visible in storage/logs/laravel.log)
            Log::warning("OTP for {$phone} could not be WhatsApp-delivered. OTP: {$otp}");
        }

        return $otp;
    }

    /**
     * Normalise a phone number to the "whatsapp:+XXXXXXX" format Twilio requires.
     * Handles:
     *   whatsapp:+2348XXXXXXXXX  → unchanged
     *   +2348XXXXXXXXX           → whatsapp:+2348XXXXXXXXX
     *   08XXXXXXXXX              → whatsapp:+2348XXXXXXXXX  (Nigerian local format)
     *   2348XXXXXXXXX            → whatsapp:+2348XXXXXXXXX
     */
    private function toWhatsAppNumber(string $phone): string
    {
        // Strip spaces and dashes
        $phone = preg_replace('/[\s\-]/', '', $phone);

        // Already fully qualified
        if (str_starts_with($phone, 'whatsapp:')) {
            return $phone;
        }

        // Nigerian local format: 08XXXXXXXXX → +2348XXXXXXXXX
        if (preg_match('/^0([7-9][0-9]{9})$/', $phone, $m)) {
            $phone = '+234' . $m[1];
        }
        // Missing + but has country code digits already
        elseif (! str_starts_with($phone, '+')) {
            $phone = '+' . $phone;
        }

        return 'whatsapp:' . $phone;
    }
}
