<?php

namespace App\Services\PayService;

use App\Services\Contracts\PaymentContract;
use Mollie\Laravel\Facades\Mollie;


class MolliePaymentService implements PaymentContract {

    public function createNewOrderPayment($amount_value,$order,$order_id){

        $payment = Mollie::api()->payments()->create([
           "amount"=>[
             "currency"=>"EUR",
             "value"=>$amount_value,
           ],
            "description"=>$order,
            "redirectUrl"=> config('services.mollie.redirect_callback'),
            "webhookUrl"=>config('services.mollie.webhook_callback'),
            "metadata"=>[
                "order_id"=>$order_id
            ],
        ]);
        return $payment->getCheckoutUrl();
    }
}
