<?php

namespace Tests\Stubs;

use Core\Domain\Event\Interfaces\UserEventManagerInterface;

class UserEventStub implements UserEventManagerInterface
{
    public function __construct()
    {
        event($this);
    }

    public function dispatch(object $event): void
    {
        //
    }
}
