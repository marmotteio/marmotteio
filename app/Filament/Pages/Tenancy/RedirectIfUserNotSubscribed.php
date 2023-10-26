<?php

namespace App\Filament\Pages\Tenancy;

use Filament\Facades\Filament;

class RedirectIfUserNotSubscribed
{
    protected function redirect(string $billableType): string
    {
        return Filament::getTenantBillingUrl();
    }
}
