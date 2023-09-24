<?php

namespace Core\Domain\Event;

interface EventInterface
{
    /**
     * @return string
     */
    public function getEventName(): string;

    /**
     * @return array
     */
    public function getPayload(): array;
}
