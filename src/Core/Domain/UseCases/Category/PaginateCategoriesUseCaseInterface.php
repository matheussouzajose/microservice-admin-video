<?php

namespace Core\Domain\UseCases\Category;

use Core\Domain\Repository\PaginationInterface;
use Core\Intermediate\Dtos\Category\PaginateCategoriesInputDto;

interface PaginateCategoriesUseCaseInterface
{
    public function execute(PaginateCategoriesInputDto $input): PaginationInterface;
}
