<?php

use App\Http\Controllers\Admin\ChatController;
use App\Http\Controllers\Auth\FacebookLoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\GoogleLoginController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Contact\ContactChatController;
use App\Http\Controllers\Contact\ContactEmailController;
use App\Http\Controllers\Contact\PusherAuthController;
use App\Http\Controllers\Payment\MollieController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use Laravel\Socialite\Facades\Socialite;


//Authentication routes
Route::post('/registration',[RegisterController::class,'registration']);
Route::post('/login',[LoginController::class,'login']);
Route::post('/password/email',[ForgotPasswordController::class,'forgot']);
Route::get('/password.reset',function (){return view('reset_password');});
Route::post('/password/reset',[ForgotPasswordController::class,'reset']);

Route::get('/auth/redirect/fb',[FacebookLoginController::class, 'auth_redirect_fb']);
Route::get('/auth/callback',[FacebookLoginController::class,'fb_login_call_back']);

Route::get('auth/redirect/google',[GoogleLoginController::class,'auth_redirect_google']);
Route::get('/auth/google/callback',[GoogleLoginController::class,'google_login_call_back']);



Route::middleware(['auth:sanctum'])->group(function(){
    Route::get('/user', function() { return auth()->user();});
    Route::post('/logout',[LoginController::class,'logout']);
    Route::post('/pusher/auth',[PusherAuthController::class,'pusher_authentication']);
});


//Contact-Page-Client : Email and Chat
Route::post('/contact/email',[ContactEmailController::class,'send_email']);
Route::middleware(['auth:sanctum'])->group(function(){

    Route::get('/chat/create_new_chat_session',[ContactChatController::class,'create_new_chat_session']);
    Route::get('/chat/get_chat_session_messages',[ContactChatController::class,'get_chat_session_messages']);
    Route::post('/chat/remove_chat_session',[ContactChatController::class,'remove_chat_session']);
    Route::post('/chat/add_message',[ContactChatController::class,'addMessage']);
});


Route::middleware(['auth:sanctum','admin'])->group(function (){
    Route::get('/admin/contact/chat/chat_session_waiting_list',[ChatController::class,'get_chat_session_waiting_list']);
});

//test routes for File Storage
Route::post('/add/file',[TestController::class,'add_file']);
Route::get('/get/file',[TestController::class,'get_file']);
Route::get('/delete/file',[TestController::class,'delete_file']);
Route::get('/get/dir',[TestController::class,'get_dir']);

//Mollie Routes testing Payment
Route::post('/create/order',[MollieController::class,'createOrder']);
Route::get('/redirect/callback/mollie',[MollieController::class,'redirectCallBack']);
Route::get('/webhook/callback/mollie',[MollieController::class,'webhookCallBack']);
