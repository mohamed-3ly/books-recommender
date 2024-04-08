<?php

namespace App\Listeners;

use App\Events\UserReadBookEvent;
use App\Facades\SMSGateway;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendSmsToUserAfterRead implements ShouldQueue
{
    use InteractsWithQueue;
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserReadBookEvent $event): void
    {
        SMSGateway::sendSMS($event->user->phone, 'Thanks for reading');
    }
}
