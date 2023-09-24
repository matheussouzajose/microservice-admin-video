<?php

namespace Core\Data\UseCases\Category\Paginate;

use Core\Data\UseCases\Category\Paginate\DTO\PaginateCategoriesInputDto;
use Core\Domain\Repository\PaginationInterface;

interface PaginateCategoriesUseCaseInterface
{
    public function execute(PaginateCategoriesInputDto $input): PaginationInterface;
}
