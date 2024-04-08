<?php

namespace App\Services\SMS\Dreivers;

use App\Services\Contracts\SMSServiceContract;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class TwilioService implements SMSServiceContract
{
    /**
     * @throws GuzzleException
     */
    public function sendSMS($phone, $message): void
    {
        logger('from T');
        $client = new Client();
        $url = 'https://run.mocky.io/v3/268d1ff4-f710-4aad-b455-a401966af719';
        $params = [
            'phone' => $phone,
            'message' => $message,
        ];
        $response = $client->request('POST', $url, [
            'json' => $params,
            'headers' => 'aplication/json',
        ]);

        logger(json_decode((string)$response->getBody()));
    }
}
