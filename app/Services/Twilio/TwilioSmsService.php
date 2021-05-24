<?php
namespace App\Services\Twilio;

use App\Services\Contracts\TwilioSmsContract;
use Twilio\Exceptions\TwilioException;
use Twilio\Http\CurlClient;
use Twilio\Rest\Client;



class TwilioSmsService implements TwilioSmsContract {

    /**
     * @throws \Twilio\Exceptions\ConfigurationException
     */
    public function send($to, $message){
        $twilioNumber = config('twilio.twilio.from');
        $client = new Client(
            config('twilio.twilio.sid'),
            config('twilio.twilio.token')
        );

        $curlOptions = [ CURLOPT_SSL_VERIFYHOST => false, CURLOPT_SSL_VERIFYPEER => false];
        $client->setHttpClient(new CurlClient($curlOptions));
        try {
            $client->messages->create( $to, ['from' => $twilioNumber, 'body' => $message]);
            return Response(['message'=>'sms send success'],201);
        }catch (TwilioException $e){
            return $e;
        }
    }
}
