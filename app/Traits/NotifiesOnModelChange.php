<?php

namespace App\Traits;

use App\Services\DiscordAlertService;

trait NotifiesOnModelChange
{
    protected static function bootNotifiesOnModelChange()
    {
        static::updated(function ($model) {
            if ($model->totalQuantityLeft() <= $model->threshold) {
                DiscordAlertService::sendAlert($model->team->discordWebhookUrl, class_basename($model)." $model->name (id=$model->id) has ".$model->totalQuantityLeft().' left.');
            }
        });
    }
}
