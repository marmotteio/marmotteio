<?php

namespace App\Providers;

use App\Http\Middleware\InitializeTenancyByCookie;
use Illuminate\Support\ServiceProvider;
use Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Livewire::addPersistentMiddleware([
            InitializeTenancyByCookie::class,
        ]);
    }
}
