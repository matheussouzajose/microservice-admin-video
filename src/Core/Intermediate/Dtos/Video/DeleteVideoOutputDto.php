<?php

namespace Core\Intermediate\Dtos\Video;

class DeleteVideoOutputDto
{
    public function __construct(
        public bool $deleted
    ) {
    }
}
