<?php

namespace Core\Application\UseCases\Video\List\DTO;

class ListVideoInputDto
{
    public function __construct(
        public string $id
    ) {
    }
}