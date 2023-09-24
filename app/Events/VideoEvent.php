<?php

namespace App\Events;

use Core\Data\UseCases\Video\Interfaces\VideoEventManagerInterface;

class VideoEvent implements VideoEventManagerInterface
{
    public function dispatch(object $event): void
    {
        event($event);
    }
}
