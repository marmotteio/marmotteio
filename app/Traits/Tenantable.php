<?php

namespace App\Traits;

trait Tenantable
{
    /**
     * Boot the Tenantable trait for a model.
     *
     * @return void
     */
    public static function bootTenantable()
    {
        static::saving(function ($model) {
            if (is_null($model->team_id)) {
                $model->team_id = \Filament\Facades\Filament::getTenant()->id;
            }
        });
    }
}
