<?php

namespace App\Listeners;

use Core\Domain\Services\UserNotificationInterface;

class SendEmailVerificationToUser
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(protected UserNotificationInterface $notification)
    {

    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        if (!$event->hasVerifiedEmail()) {
            $this->notification->send(
                payload: $event->getPayload()
            );
        }

//        if (!$event->user->hasVerifiedEmail()) {
//            $event->user->sendEmailVerificationNotification();
//        }
    }
}
