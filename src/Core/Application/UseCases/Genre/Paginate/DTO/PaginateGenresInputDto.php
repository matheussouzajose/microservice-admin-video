<?php

namespace Core\Application\UseCases\Genre\Paginate\DTO;

class PaginateGenresInputDto
{
    public function __construct(
        public string $filter = '',
        public string $order = 'DESC',
        public int $page = 1,
        public int $totalPage = 15,
    ) {
    }
}
