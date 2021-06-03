<?php

use App\Http\Controllers\Auth\FacebookLoginController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;


Route::get('/', function () {
    return view('welcome');
});
Route::view('forgot_password', 'auth.reset_password')->name('password.reset');


Route::get('/auth/facebook',[FacebookLoginController::class,'redirectFacebook'])->name('auth.facebook');

Route::get('/auth/facebook/callback',function (){
    $user = Socialite::driver('facebook')->user();
    return view('welcome',[$user]);
});
