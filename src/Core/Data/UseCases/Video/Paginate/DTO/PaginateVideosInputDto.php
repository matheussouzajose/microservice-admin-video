<?php

namespace Core\Data\UseCases\Video\Paginate\DTO;

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
