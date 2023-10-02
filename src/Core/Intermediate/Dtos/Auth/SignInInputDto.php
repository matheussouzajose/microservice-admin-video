<?php

namespace Core\Intermediate\Dtos\Auth;

class SignInInputDto
{
    public function __construct(
        public string $email,
        public string $password,
    ) {
    }
}
