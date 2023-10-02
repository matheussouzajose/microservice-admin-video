<?php

namespace Core\Domain\UseCases\Category;

use Core\Intermediate\Dtos\Category\ListCategoryInputDto;
use Core\Intermediate\Dtos\Category\ListCategoryOutputDto;

interface ListCategoryUseCaseInterface
{
    public function execute(ListCategoryInputDto $input): ListCategoryOutputDto;
}
