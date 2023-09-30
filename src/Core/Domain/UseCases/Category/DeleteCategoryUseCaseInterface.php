<?php

namespace Core\Domain\UseCases\Category;

use Core\Intermediate\Dtos\Category\DeleteCategoryInputDto;
use Core\Intermediate\Dtos\Category\DeleteCategoryOutputDto;

interface DeleteCategoryUseCaseInterface
{
    public function execute(DeleteCategoryInputDto $input): DeleteCategoryOutputDto;
}
