<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

/**
 * Responsible for redirecting the user to the FusionAuth login page
 */
Route::get('/auth/redirect', function () {
    return Socialite::driver('fusionauth')->redirect();
})->name('login');

/**
 * This is the address that we configured in our .env file which the user will be redirected to after completing the
 * login process
 */
Route::get('/auth/callback', function () {
    /** @var \SocialiteProviders\Manager\OAuth2\User $user */
    $user = Socialite::driver('fusionauth')->user();

    // Let's create a new entry in our users table (or update if it already exists) with some information from the user
    $user = User::updateOrCreate([
        'fusionauth_id' => $user->id,
    ], [
        'name' => $user->name,
        'email' => $user->email,
        'fusionauth_access_token' => $user->token,
        'fusionauth_refresh_token' => $user->refreshToken,
    ]);

    // Logging the user in
    Auth::login($user);

    // Here, you should redirect to your app's authenticated pages (e.g. the user dashboard)
    return redirect('/');
});

