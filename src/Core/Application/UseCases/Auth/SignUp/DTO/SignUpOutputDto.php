<?php

namespace Core\Application\UseCases\Auth\SignUp\DTO;

class SignUpOutputDto
{
    public function __construct(
        public string $id,
        public string $firstName,
        public string $lastName,
        public string $email,
        public string $createdAt,
        public ?string $emailVerifiedAt = null,
    ) {
    }
}
