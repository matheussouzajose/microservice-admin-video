<?php

namespace Core\Intermediate\Dtos\Auth;

class RefreshTokenOutputDto
{
    public function __construct(
        public string $accessToken,
        public string $tokenType
    ) {
    }
}
