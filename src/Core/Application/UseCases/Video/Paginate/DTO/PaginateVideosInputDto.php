<?php

namespace Core\Application\UseCases\Video\Paginate\DTO;

class PaginateVideosInputDto
{
    public function __construct(
        public string $filter = '',
        public string $order = 'DESC',
        public int $page = 1,
        public int $totalPerPage = 15,
    ) {
    }
}
