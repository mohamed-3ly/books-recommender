<?php

namespace App\Providers;

use App\Services\Contracts\SMSServiceContract;
use App\Services\SMS\Dreivers\SMSEgyptService;
use App\Services\SMS\Dreivers\TwilioService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(SMSServiceContract::class, function ($app) {
            if (config('services.sms') == 'twiilio') {
                return new TwilioService();
            } elseif (config('services.sms') == 'smsEgypt') {
                return new SMSEgyptService();
            } else {
                throw new \Exception('not implemented');
            }
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
