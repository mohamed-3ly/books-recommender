<?php

namespace App\Services\SMS\Dreivers;

use App\Services\Contracts\SMSServiceContract;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class SMSEgyptService implements SMSServiceContract
{
    /**
     * @throws GuzzleException
     */
    public function sendSMS($phone, $message): void
    {
        logger('from S');
        $client = new Client();
        $url = 'https://run.mocky.io/v3/8eb88272-d769-417c-8c5c-159bb023ec0a';

        $params = [
            'phone' => $phone,
            'message' => $message,
        ];

        $response = $client->request('POST', $url, [
            'json' => $params,
            'headers' => ['accept' => 'aplication/json'],
        ]);

        logger(json_decode((string)$response->getBody()));
    }
}
