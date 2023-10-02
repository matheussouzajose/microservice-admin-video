<?php

namespace Core\Intermediate\Dtos\Auth;

class SignUpOutputDto
{
    public function __construct(
        public string $id,
        public string $firstName,
        public string $lastName,
        public string $email,
        public string $createdAt
    ) {
    }
}
