<?php

namespace Core\Data\UseCases\Video\Paginate\DTO;

class PaginateVideosOutputDto
{
    /**
     * @param array $items
     * @param int $total
     * @param int $current_page
     * @param int $last_page
     * @param int $first_page
     * @param int $per_page
     * @param int $to
     * @param int $from
     */
    public function __construct(
        public array $items,
        public int $total,
        public int $current_page,
        public int $last_page,
        public int $first_page,
        public int $per_page,
        public int $to,
        public int $from,
    ) {
    }
}
