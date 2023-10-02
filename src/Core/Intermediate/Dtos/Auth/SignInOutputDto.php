<?php

namespace Core\Intermediate\Dtos\Auth;

class SignInOutputDto
{
    public function __construct(
        public string $accessToken,
        public string $tokenType
    ) {
    }
}
