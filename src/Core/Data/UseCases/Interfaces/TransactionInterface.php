<?php

namespace Core\Data\UseCases\Interfaces;

interface TransactionInterface
{
    public function commit(): void;

    public function rollback(): void;
}
