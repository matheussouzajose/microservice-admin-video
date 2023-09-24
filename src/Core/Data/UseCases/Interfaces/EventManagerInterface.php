<?php

namespace Core\Data\UseCases\Interfaces;

interface EventManagerInterface
{
    /**
     * @param object $event
     * @return void
     */
    public function dispatch(object $event): void;
}
