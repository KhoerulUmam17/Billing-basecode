<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;

class LogSuccessfulLogout
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
     * @param  \IlluminateAuthEventsLogout  $event
     * @return void
     */
    public function handle(Logout $event)
    {
        activity('logout')->causedBy($event->user)->log('User Logged Out');
    }
}
