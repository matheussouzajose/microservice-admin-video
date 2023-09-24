<?php

namespace Core\Data\UseCases\Category\Update;

use Core\Data\UseCases\Category\Update\DTO\UpdateCategoryInputDto;
use Core\Data\UseCases\Category\Update\DTO\UpdateCategoryOutputDto;

interface UpdateCategoryUseCaseInterface
{
    /**
     * @param UpdateCategoryInputDto $input
     * @return UpdateCategoryOutputDto
     */
    public function execute(UpdateCategoryInputDto $input): UpdateCategoryOutputDto;
}
