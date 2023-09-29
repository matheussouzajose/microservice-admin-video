<?php

namespace Core\Application\UseCases\Category\Delete;

use Core\Application\UseCases\Category\Delete\DTO\DeleteCategoryInputDto;
use Core\Application\UseCases\Category\Delete\DTO\DeleteCategoryOutputDto;

interface DeleteCategoryUseCaseInterface
{
    public function execute(DeleteCategoryInputDto $input): DeleteCategoryOutputDto;
}
