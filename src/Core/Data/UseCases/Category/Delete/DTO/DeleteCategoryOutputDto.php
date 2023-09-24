<?php

namespace Core\Data\UseCases\Category\Delete\DTO;

class DeleteCategoryOutputDto
{
    /**
     * @param bool $success
     */
    public function __construct(
        public bool $success
    ) {
    }
}
