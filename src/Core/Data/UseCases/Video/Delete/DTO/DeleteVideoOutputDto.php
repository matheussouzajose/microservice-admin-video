<?php

namespace Core\Data\UseCases\Video\Delete\DTO;

class DeleteVideoOutputDto
{
    /**
     * @param bool $deleted
     */
    public function __construct(
        public bool $deleted
    ) {
    }
}
