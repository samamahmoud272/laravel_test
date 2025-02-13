<?php

namespace App\Listeners;

use App\Events\UserVerified;
use App\Notifications\VerifiedUserNotification;


class SendVerficationEmail
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
     * @param  \App\Events\UserVerified  $event
     * @return void
     */
    public function handle(UserVerified $event)
    {
        $event->user->notify(new VerifiedUserNotification($event->user));

    }
}
