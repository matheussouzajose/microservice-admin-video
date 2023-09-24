<?php

namespace Tests\Stubs;

use Core\Data\UseCases\Video\Interfaces\VideoEventManagerInterface;

class VideoEventStub implements VideoEventManagerInterface
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
