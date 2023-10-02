<?php

namespace Core\Domain\UseCases\Category;

use Core\Intermediate\Dtos\Category\UpdateCategoryInputDto;
use Core\Intermediate\Dtos\Category\UpdateCategoryOutputDto;

interface UpdateCategoryUseCaseInterface
{
    public function execute(UpdateCategoryInputDto $input): UpdateCategoryOutputDto;
}
