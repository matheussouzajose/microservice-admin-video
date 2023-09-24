<?php

namespace Core\Domain\Event;

interface EventInterface
{
    public function getEventName(): string;

    public function getPayload(): array;
}
