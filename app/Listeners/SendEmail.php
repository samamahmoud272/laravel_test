<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Notifications\RegisteredUserNotification;

class SendEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        $event->user->notify(new RegisteredUserNotification($event->user));
    }
}
