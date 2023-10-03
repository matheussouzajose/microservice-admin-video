<?php

namespace Core\Intermediate\Dtos\Auth;

class LogoutOutputDto
{
    public function __construct(
        public bool $disconnected
    ) {
    }
}
