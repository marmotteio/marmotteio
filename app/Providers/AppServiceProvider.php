<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire;
use App\Http\Middleware\InitializeTenancyByCookie;

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
