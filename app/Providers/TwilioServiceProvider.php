<?php

namespace App\Providers;
use App\Services\Contracts\TwilioSmsContract;
use App\Services\Twilio\TwilioSmsService;
use Illuminate\Support\ServiceProvider;



class TwilioServiceProvider extends ServiceProvider{

    //bind interface with class

    public function register(){
        $this->app->bind(TwilioSmsContract::class,TwilioSmsService::class);
    }

}
