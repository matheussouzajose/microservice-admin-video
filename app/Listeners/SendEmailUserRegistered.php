<?php

namespace App\Listeners;

class SendEmailUserRegistered
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        //        dd($event);
    }
}
