<?php

namespace Core\Data\UseCases\Category\Create;

use Core\Data\UseCases\Category\Create\DTO\CreateCategoryInputDto;
use Core\Data\UseCases\Category\Create\DTO\CreateCategoryOutputDto;

interface CreateCategoryUseCaseInterface
{
    public function execute(CreateCategoryInputDto $input): CreateCategoryOutputDto;
}
