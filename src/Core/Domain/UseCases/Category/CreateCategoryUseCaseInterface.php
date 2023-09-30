<?php

namespace Core\Domain\UseCases\Category;

use Core\Intermediate\Dtos\Category\CreateCategoryInputDto;
use Core\Intermediate\Dtos\Category\CreateCategoryOutputDto;

interface CreateCategoryUseCaseInterface
{
    public function execute(CreateCategoryInputDto $input): CreateCategoryOutputDto;
}
