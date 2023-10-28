<?php

namespace App\Services;

use Spatie\DiscordAlerts\Facades\DiscordAlert;

class DiscordAlertService
{
    public static function sendAlert($webhookUrl, $message)
    {
        DiscordAlert::to($webhookUrl)->message($message);
    }
}
