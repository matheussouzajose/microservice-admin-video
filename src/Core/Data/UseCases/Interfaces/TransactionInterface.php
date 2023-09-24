<?php

namespace Core\Data\UseCases\Interfaces;

interface TransactionInterface
{
    /**
     * @return void
     */
    public function commit(): void;

    /**
     * @return void
     */
    public function rollback(): void;
}
