<?php

namespace Core\Application\UseCases\Auth\SignUp\DTO;

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
