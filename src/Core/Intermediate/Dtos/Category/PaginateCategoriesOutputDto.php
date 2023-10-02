<?php

namespace Core\Intermediate\Dtos\Category;

class PaginateCategoriesOutputDto
{
    /**
     * @param  \stdClass[]  $items
     */
    public function __construct(
        public array $items,
        public int $total,
        public int $lastPage,
        public int $firstPage,
        public int $currentPage,
        public int $perPage,
        public int $to,
        public int $from
    ) {
    }
}
