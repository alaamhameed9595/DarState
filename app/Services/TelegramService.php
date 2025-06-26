<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class TelegramService
{
    protected $token;
    protected $chatId;

    public function __construct()
    {
        $this->token = config('services.telegram.bot_token', env('TELEGRAM_BOT_TOKEN'));
        $this->chatId = config('services.telegram.chat_id', env('TELEGRAM_CHAT_ID'));
    }


    public function sendMessage(string $message): bool
    {
        $url = "https://api.telegram.org/bot{$this->token}/sendMessage";
        $response = Http::post($url, [
            'chat_id' => $this->chatId,
            'text' => $message,
            'parse_mode' => 'HTML',
        ]);
        if (!$response->successful()) {
            Log::error('Telegram API error', [
                'status' => $response->status(),
                'body' => $response->body(),
                'chat_id' => $this->chatId,
                'bot_token' => substr($this->token, 0, 10) . '...'
            ]);
        }
        return $response->successful();
    }

    public function sendPhoto(string $caption, string $imageUrl)
    {
        return Http::post("https://api.telegram.org/bot{$this->token}/sendPhoto", [
            'chat_id' => $this->chatId,
            'caption' => $caption,
            'photo' => $imageUrl,
        ]);
    }
    /**
     * Send a message to the configured Telegram chat.
     *
     * @param string $message
     * @return bool
     */
}
