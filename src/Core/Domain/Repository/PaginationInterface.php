<?php

namespace Core\Domain\Repository;

interface PaginationInterface
{
    /**
     * @return \stdClass[]
     */
    public function items(): array;

    /**
     * @return int
     */
    public function total(): int;

    /**
     * @return int
     */
    public function lastPage(): int;

    /**
     * @return int
     */
    public function firstPage(): int;

    /**
     * @return int
     */
    public function currentPage(): int;

    /**
     * @return int
     */
    public function perPage(): int;

    /**
     * @return int
     */
    public function to(): int;

    /**
     * @return int
     */
    public function from(): int;
}
