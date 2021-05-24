<?php

namespace App\Services\Contracts;

interface TwilioSmsContract{

    public function send($to, $message);

}
