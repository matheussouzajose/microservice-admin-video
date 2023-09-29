<?php

namespace Core\Application\UseCases\Interfaces;

interface TransactionInterface
{
    public function commit(): void;

    public function rollback(): void;
}
