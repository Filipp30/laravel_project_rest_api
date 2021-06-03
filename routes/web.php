<?php

use App\Http\Controllers\Auth\FacebookLoginController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;


Route::get('/', function () {
    return view('welcome');
});
Route::view('forgot_password', 'auth.reset_password')->name('password.reset');

