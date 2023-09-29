<?php

namespace Core\Application\UseCases\CastMember\Paginate\DTO;

class PaginateCastMembersInputDto
{
    public function __construct(
        public string $filter = '',
        public string $order = 'DESC',
        public int $page = 1,
        public int $totalPerPage = 15,
    ) {
    }
}
