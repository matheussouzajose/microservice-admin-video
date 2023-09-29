<?php

namespace Core\Application\UseCases\Category\Update;

use Core\Application\UseCases\Category\Update\DTO\UpdateCategoryInputDto;
use Core\Application\UseCases\Category\Update\DTO\UpdateCategoryOutputDto;

interface UpdateCategoryUseCaseInterface
{
    public function execute(UpdateCategoryInputDto $input): UpdateCategoryOutputDto;
}
