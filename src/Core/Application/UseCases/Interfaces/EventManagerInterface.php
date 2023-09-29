<?php

namespace Core\Application\UseCases\Interfaces;

interface EventManagerInterface
{
    public function dispatch(object $event): void;
}
