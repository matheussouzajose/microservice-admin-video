<?php

namespace Core\Data\UseCases\Category\Delete;

use Core\Data\UseCases\Category\Delete\DTO\DeleteCategoryInputDto;
use Core\Data\UseCases\Category\Delete\DTO\DeleteCategoryOutputDto;

interface DeleteCategoryUseCaseInterface
{
    /**
     * @param DeleteCategoryInputDto $input
     * @return DeleteCategoryOutputDto
     */
    public function execute(DeleteCategoryInputDto $input): DeleteCategoryOutputDto;
}
