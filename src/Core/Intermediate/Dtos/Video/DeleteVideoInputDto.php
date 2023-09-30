<?php

namespace Core\Intermediate\Dtos\Video;

class DeleteVideoInputDto
{
    public function __construct(
        public string $id
    ) {
    }
}
