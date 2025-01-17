<?php

namespace App\Facades;

use App\Services\Contracts\SMSServiceContract;
use Illuminate\Support\Facades\Facade;

class SMSGateway extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return SMSServiceContract::class;
    }
}
