<?php

namespace Core\Application\UseCases\Category\Create;

use Core\Application\UseCases\Category\Create\DTO\CreateCategoryInputDto;
use Core\Application\UseCases\Category\Create\DTO\CreateCategoryOutputDto;

interface CreateCategoryUseCaseInterface
{
    public function execute(CreateCategoryInputDto $input): CreateCategoryOutputDto;
}
