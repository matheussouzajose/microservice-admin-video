<?php

namespace Core\Intermediate\Dtos\Auth;

class RefreshTokenInputDto
{
    public function __construct(
        public string $id
    ) {
    }
}
