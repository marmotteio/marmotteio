<?php

namespace App\Filament\Pages\Tenancy;

use App\Models\Account;
use Closure;
use Filament\Billing\Providers\Contracts\Provider;
use Illuminate\Http\RedirectResponse;

class ExampleBillingProvider implements Provider
{
    public function getRouteAction(): string|Closure|array
    {
        return function (): RedirectResponse {
            $account = Account::firstOrCreate();

            return $account->redirectToBillingPortal(route('home'));
        };
    }

    public function getSubscribedMiddleware(): string
    {
        return RedirectIfUserNotSubscribed::class;
    }
}
