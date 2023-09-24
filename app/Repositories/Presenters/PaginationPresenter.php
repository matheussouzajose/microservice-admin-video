<?php

namespace App\Repositories\Presenters;

use Core\Domain\Repository\PaginationInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class PaginationPresenter implements PaginationInterface
{
    /** @return \stdClass[] */
    protected array $items = [];

    /**
     * @param LengthAwarePaginator $paginator
     */
    public function __construct(
        protected LengthAwarePaginator $paginator
    ) {
        $this->items = $this->resolveItems(
            items: $this->paginator->items()
        );
    }

    /**
     * @return \stdClass[]
     */
    public function items(): array
    {
        return $this->items;
    }

    /**
     * @return int
     */
    public function total(): int
    {
        return $this->paginator->total() ?? 0;
    }

    /**
     * @return int
     */
    public function lastPage(): int
    {
        return $this->paginator->lastPage() ?? 0;
    }

    /**
     * @return int
     */
    public function firstPage(): int
    {
        return $this->paginator->firstItem() ?? 0;
    }

    /**
     * @return int
     */
    public function currentPage(): int
    {
        return $this->paginator->currentPage() ?? 0;
    }

    /**
     * @return int
     */
    public function perPage(): int
    {
        return $this->paginator->perPage() ?? 0;
    }

    /**
     * @return int
     */
    public function to(): int
    {
        return $this->paginator->firstItem() ?? 0;
    }

    /**
     * @return int
     */
    public function from(): int
    {
        return $this->paginator->lastItem() ?? 0;
    }

    /**
     * @param array $items
     * @return array
     */
    private function resolveItems(array $items): array
    {
        $response = [];

        foreach ($items as $item) {
            $stdClass = new \stdClass;
            foreach ($item->toArray() as $key => $value) {
                $stdClass->{$key} = $value;
            }

            $response[] = $stdClass;
        }

        return $response;
    }
}
