<?php

namespace App\Providers;
use App\Services\Twilio\TwilioSmsService;
use Illuminate\Support\ServiceProvider;



class TwilioServiceProvider extends ServiceProvider{

    //bind interface with class

    public function register(){
        $this->app->bind('App\Services\Contracts\TwilioSmsContract',function ($app){
            return new TwilioSmsService();
        });
    }

}
