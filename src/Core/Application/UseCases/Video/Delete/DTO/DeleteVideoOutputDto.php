<?php

namespace Core\Application\UseCases\Video\Delete\DTO;

class DeleteVideoOutputDto
{
    public function __construct(
        public bool $deleted
    ) {
    }
}
