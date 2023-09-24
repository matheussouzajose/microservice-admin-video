<?php

namespace App\Repositories\Transaction;

use Core\Data\UseCases\Interfaces\TransactionInterface;
use Illuminate\Support\Facades\DB;

class DBTransaction implements TransactionInterface
{
    /**
     *
     */
    public function __construct()
    {
        DB::beginTransaction();
    }

    /**
     * @return void
     */
    public function commit(): void
    {
        DB::commit();
    }

    /**
     * @return void
     */
    public function rollback(): void
    {
        DB::rollBack();
    }
}
