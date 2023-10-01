<?php

namespace App\Events;

use Core\Application\UseCases\Auth\Interfaces\UserEventManagerInterface;

class UserEventManager implements UserEventManagerInterface
{
    public function dispatch(object $event): void
    {
        event($event);
    }
}
