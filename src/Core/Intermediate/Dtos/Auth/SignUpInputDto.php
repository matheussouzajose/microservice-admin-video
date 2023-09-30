<?php

namespace Core\Intermediate\Dtos\Auth;

class SignUpInputDto
{
    public function __construct(
        public string $firstName,
        public string $lastName,
        public string $email,
        public string $password,
    ) {
    }
}
