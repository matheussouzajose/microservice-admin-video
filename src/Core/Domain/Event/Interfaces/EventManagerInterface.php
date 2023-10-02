<?php

namespace Core\Domain\Event\Interfaces;

interface EventManagerInterface
{
    public function dispatch(object $event): void;
}
