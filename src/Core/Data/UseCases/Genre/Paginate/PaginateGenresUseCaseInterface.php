<?php

namespace Core\Data\UseCases\Genre\Paginate;

use Core\Data\UseCases\Genre\Paginate\DTO\PaginateGenresInputDto;
use Core\Domain\Repository\PaginationInterface;

interface PaginateGenresUseCaseInterface
{
    /**
     * @param PaginateGenresInputDto $input
     * @return PaginationInterface
     */
    public function execute(PaginateGenresInputDto $input): PaginationInterface;
}
