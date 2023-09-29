<?php

namespace Core\Application\UseCases\Category\Paginate;

use Core\Application\UseCases\Category\Paginate\DTO\PaginateCategoriesInputDto;
use Core\Domain\Repository\PaginationInterface;

interface PaginateCategoriesUseCaseInterface
{
    public function execute(PaginateCategoriesInputDto $input): PaginationInterface;
}
