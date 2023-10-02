<?php

namespace Core\Domain\UseCases\Video;

use Core\Domain\Repository\PaginationInterface;
use Core\Intermediate\Dtos\Video\PaginateVideosInputDto;

interface PaginateVideosUseCaseInterface
{
    public function execute(PaginateVideosInputDto $input): PaginationInterface;
}
