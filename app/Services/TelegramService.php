<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramService
{
    private string $token;
    private string $chatId;

    public function __construct()
    {
        $this->token  = config('services.telegram.bot_token', '');
        $this->chatId = config('services.telegram.chat_id', '');
    }

    public function isConfigured(): bool
    {
        return $this->token !== '' && $this->chatId !== '';
    }

    public function send(string $message): bool
    {
        if (! $this->isConfigured()) {
            return false;
        }

        try {
            $response = Http::post("https://api.telegram.org/bot{$this->token}/sendMessage", [
                'chat_id'    => $this->chatId,
                'text'       => $message,
                'parse_mode' => 'HTML',
            ]);

            return $response->successful();
        } catch (\Exception $e) {
            Log::error('Telegram notification failed: ' . $e->getMessage());
            return false;
        }
    }

    public function notifyNewMessage(string $name, string $email, string $phone, string $service, string $message): bool
    {
        $service = $service ?: 'Not specified';
        $phone   = $phone   ?: 'Not provided';

        $text = "📩 <b>New Contact Message</b>\n\n"
              . "👤 <b>Name:</b> {$name}\n"
              . "📧 <b>Email:</b> {$email}\n"
              . "📱 <b>Phone:</b> {$phone}\n"
              . "🏷 <b>Service:</b> {$service}\n\n"
              . "💬 <b>Message:</b>\n{$message}\n\n"
              . "🔗 <a href=\"" . config('app.url') . "/admin?panel=messages\">View in Dashboard</a>";

        return $this->send($text);
    }
}
