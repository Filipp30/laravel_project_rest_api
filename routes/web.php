<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;


Route::get('/', function () {
    return view('welcome');
});
Route::view('forgot_password', 'auth.reset_password')->name('password.reset');

Route::get('/auth/redirect', function () {
    return Socialite::driver('facebook')->redirect();
})->name('auth.facebook');
