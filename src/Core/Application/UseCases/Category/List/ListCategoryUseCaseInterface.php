<?php

namespace Core\Application\UseCases\Category\List;

use Core\Application\UseCases\Category\List\DTO\ListCategoryInputDto;
use Core\Application\UseCases\Category\List\DTO\ListCategoryOutputDto;

interface ListCategoryUseCaseInterface
{
    public function execute(ListCategoryInputDto $input): ListCategoryOutputDto;
}
