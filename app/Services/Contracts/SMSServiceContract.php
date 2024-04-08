<?php

namespace App\Services\Contracts;

interface SMSServiceContract
{
    public function sendSMS($phone, $message);
}
