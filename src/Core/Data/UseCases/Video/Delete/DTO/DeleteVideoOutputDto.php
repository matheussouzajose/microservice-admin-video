<?php

namespace Core\Data\UseCases\Video\Delete\DTO;

class DeleteVideoOutputDto
{
    public function __construct(
        public bool $deleted
    ) {
    }
}
