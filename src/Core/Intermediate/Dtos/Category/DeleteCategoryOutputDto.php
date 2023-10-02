<?php

namespace Core\Intermediate\Dtos\Category;

class DeleteCategoryOutputDto
{
    public function __construct(
        public bool $success
    ) {
    }
}
