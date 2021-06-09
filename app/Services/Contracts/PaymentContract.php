<?php


namespace App\Services\Contracts;


use Illuminate\Http\Request;

interface PaymentContract{

    public function createNewOrderPayment($amount_value,$order,$order_id);

}
