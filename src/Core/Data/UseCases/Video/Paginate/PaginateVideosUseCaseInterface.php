<?php

namespace Core\Data\UseCases\Video\Paginate;

use Core\Data\UseCases\Video\Paginate\DTO\PaginateVideosInputDto;
use Core\Domain\Repository\PaginationInterface;

interface PaginateVideosUseCaseInterface
{
    /**
     * @param PaginateVideosInputDto $input
     * @return PaginationInterface
     */
    public function execute(PaginateVideosInputDto $input): PaginationInterface;
}
