<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Services\Contracts\PaymentContract;
use Illuminate\Http\Request;

class MollieController extends Controller
{
    public function createOrder(Request $request){
        $order_payment = app(PaymentContract::class);
        $pay_redirect_url = $order_payment->createNewOrderPayment($request['amount'],$request['order'],$request['user_id']);
        return response([
            'redirect_uri'=>$pay_redirect_url,
        ],201);
    }

    public function redirectCallBack(Request $request){
        dd($request);
    }

    public function webhookCallBack(Request $request){
        $paymentId = $request->input('id');
        $payment = Mollie()->payments->get($paymentId);
        dd($payment);

//        if ($payment->isPaid())
//        {
//            echo 'Payment received.';
//        }
    }
}
