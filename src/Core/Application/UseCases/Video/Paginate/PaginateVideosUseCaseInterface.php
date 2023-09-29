<?php

namespace Core\Application\UseCases\Video\Paginate;

use Core\Application\UseCases\Video\Paginate\DTO\PaginateVideosInputDto;
use Core\Domain\Repository\PaginationInterface;

interface PaginateVideosUseCaseInterface
{
    public function execute(PaginateVideosInputDto $input): PaginationInterface;
}
