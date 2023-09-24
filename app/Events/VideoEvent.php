<?php

namespace App\Events;

use Core\Data\UseCases\Video\Interfaces\VideoEventManagerInterface;

class VideoEvent implements VideoEventManagerInterface
{

    /**
     * @param object $event
     * @return void
     */
    public function dispatch(object $event): void
    {
        event($event);
    }
}
