<?php

namespace Core\Application\UseCases\Category\Delete\DTO;

class DeleteCategoryOutputDto
{
    public function __construct(
        public bool $success
    ) {
    }
}
