<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Contact\ContactChatController;
use App\Http\Controllers\Contact\ContactEmailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;

//Authentication routes
Route::post('/registration',[RegisterController::class,'registration']);
Route::post('/login',[LoginController::class,'login']);
Route::post('/password/email',[ForgotPasswordController::class,'forgot']);
Route::get('/password.reset',function (){return view('reset_password');});
Route::post('/password/reset',[ForgotPasswordController::class,'reset']);
Route::middleware(['auth:sanctum'])->group(function(){
    Route::get('/user', function() { return auth()->user();});
    Route::post('/logout',[LoginController::class,'logout']);
});



//Contact-Page  routes : Email and Chat
Route::post('/contact/email',[ContactEmailController::class,'send_email']);

Route::middleware(['auth:sanctum'])->group(function(){
    Route::get('chat/create_new_chat_session',[ContactChatController::class,'create_new_chat_session']);
    Route::get('chat/get_chat_session_messages',[ContactChatController::class,'get_chat_session_messages']);
    Route::post('chat/remove_chat_session',[ContactChatController::class,'remove_chat_session']);
    Route::post('chat/add_message',[ContactChatController::class,'addMessage']);
});

Route::post('/pusher/auth',function (){
    return true;
})->middleware(['pusher.auth']);



Route::middleware(['auth:sanctum','admin'])->group(function (){

});


