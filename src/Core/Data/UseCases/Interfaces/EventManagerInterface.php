<?php

namespace Core\Data\UseCases\Interfaces;

interface EventManagerInterface
{
    public function dispatch(object $event): void;
}
