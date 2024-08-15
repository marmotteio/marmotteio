<?php

use App\Http\Middleware\InitializeTenancyByCookie;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByCookie::class,
])->group(function () {
    Route::get('/', function () {
        return redirect('/admin');
    })->name('login');

    Route::get('/auth/redirect', function () {
        return Socialite::driver('github')->redirect();
    });

    Route::get('/auth/callback', function () {
        $githubUser = Socialite::driver('github')->user();

        $user = User::whereEmail($githubUser->email)->firstOrFail();

        Auth::login($user);

        return redirect('/admin');
    });
});
