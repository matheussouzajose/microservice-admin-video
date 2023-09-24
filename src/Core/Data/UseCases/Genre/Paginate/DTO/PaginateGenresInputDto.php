<?php

namespace Core\Data\UseCases\Genre\Paginate\DTO;

class PaginateGenresInputDto
{
    /**
     * @param string $filter
     * @param string $order
     * @param int $page
     * @param int $totalPage
     */
    public function __construct(
        public string $filter = '',
        public string $order = 'DESC',
        public int $page = 1,
        public int $totalPage = 15,
    ) {
    }
}
