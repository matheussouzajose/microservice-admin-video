<?php

namespace Core\Intermediate\Dtos\Auth;

class LogoutInputDto
{
    public function __construct(
        public string $id
    ) {
    }
}
