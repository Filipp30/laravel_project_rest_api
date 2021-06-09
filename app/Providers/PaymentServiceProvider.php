<?php

namespace App\Providers;

use App\Services\Contracts\PaymentContract;
use App\Services\PayService\MolliePaymentService;
use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{

    public function register(){
        $this->app->bind(PaymentContract::class,MolliePaymentService::class);
    }

}
