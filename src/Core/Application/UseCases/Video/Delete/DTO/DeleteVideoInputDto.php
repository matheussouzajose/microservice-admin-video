<?php

namespace Core\Application\UseCases\Video\Delete\DTO;

class DeleteVideoInputDto
{
    public function __construct(
        public string $id
    ) {
    }
}