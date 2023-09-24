<?php

namespace Core\Data\UseCases\Category\List;

use Core\Data\UseCases\Category\List\DTO\ListCategoryInputDto;
use Core\Data\UseCases\Category\List\DTO\ListCategoryOutputDto;

interface ListCategoryUseCaseInterface
{
    /**
     * @param ListCategoryInputDto $input
     * @return ListCategoryOutputDto
     */
    public function execute(ListCategoryInputDto $input): ListCategoryOutputDto;
}
