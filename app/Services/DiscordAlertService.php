<?php

namespace App\Services;

use Spatie\DiscordAlerts\Facades\DiscordAlert;

class DiscordAlertService
{
    public static function sendAlert($webhookUrl, $message)
    {
        if (empty($webhookUrl) || empty($message)) {
            return;
        }

        DiscordAlert::to($webhookUrl)->message($message);
    }
}
