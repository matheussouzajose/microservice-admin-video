<?php

namespace Core\Intermediate\Dtos\Category;

class DeleteCategoryInputDto
{
    public function __construct(
        public string $id,
    ) {
    }
}
