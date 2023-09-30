<?php

namespace Core\Domain\UseCases\Genre;

use Core\Domain\Repository\PaginationInterface;
use Core\Intermediate\Dtos\Genre\PaginateGenresInputDto;

interface PaginateGenresUseCaseInterface
{
    public function execute(PaginateGenresInputDto $input): PaginationInterface;
}
