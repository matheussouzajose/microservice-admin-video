<?php

namespace Core\Domain\UseCases\Auth;

use Core\Intermediate\Dtos\Auth\SignInInputDto;
use Core\Intermediate\Dtos\Auth\SignInOutputDto;

interface SignInUseCaseInterface
{
    public function execute(SignInInputDto $input): SignInOutputDto;
}
