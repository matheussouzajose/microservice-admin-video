<?php

namespace App\Events;

use Core\Domain\Event\Interfaces\UserEventManagerInterface;

class UserEventManager implements UserEventManagerInterface
{
    public function dispatch(object $event): void
    {
        event($event);
    }
}
