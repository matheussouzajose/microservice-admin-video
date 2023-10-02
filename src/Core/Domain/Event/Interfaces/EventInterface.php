<?php

namespace Core\Domain\Event\Interfaces;

interface EventInterface
{
    public function getEventName(): string;

    public function getPayload(): array;
}
