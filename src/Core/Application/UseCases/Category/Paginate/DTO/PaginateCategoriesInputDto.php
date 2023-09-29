<?php

namespace Core\Application\UseCases\Category\Paginate\DTO;

class PaginateCategoriesInputDto
{
    public function __construct(
        public string $filter = '',
        public string $order = 'DESC',
        public int $page = 1,
        public int $totalPage = 15,
    ) {
    }
}
