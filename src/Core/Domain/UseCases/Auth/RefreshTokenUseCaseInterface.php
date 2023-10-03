<?php

namespace Core\Domain\UseCases\Auth;

use Core\Intermediate\Dtos\Auth\RefreshTokenInputDto;
use Core\Intermediate\Dtos\Auth\RefreshTokenOutputDto;

interface RefreshTokenUseCaseInterface
{
    public function execute(RefreshTokenInputDto $input): RefreshTokenOutputDto;
}
