<?php

namespace Core\Domain\UseCases\Auth;

use Core\Intermediate\Dtos\Auth\LogoutInputDto;
use Core\Intermediate\Dtos\Auth\LogoutOutputDto;

interface LogoutUseCaseInterface
{
    public function execute(LogoutInputDto $input): LogoutOutputDto;
}
