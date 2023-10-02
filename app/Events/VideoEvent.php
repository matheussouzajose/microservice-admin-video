<?php

namespace App\Events;

use Core\Domain\Event\Interfaces\VideoEventManagerInterface;

class VideoEvent implements VideoEventManagerInterface
{
    public function dispatch(object $event): void
    {
        event($event);
    }
}
