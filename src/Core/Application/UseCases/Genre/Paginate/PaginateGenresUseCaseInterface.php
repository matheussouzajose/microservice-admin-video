<?php

namespace Core\Application\UseCases\Genre\Paginate;

use Core\Application\UseCases\Genre\Paginate\DTO\PaginateGenresInputDto;
use Core\Domain\Repository\PaginationInterface;

interface PaginateGenresUseCaseInterface
{
    public function execute(PaginateGenresInputDto $input): PaginationInterface;
}
