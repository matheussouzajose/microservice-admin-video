<?php

namespace Core\Application\UseCases\Auth\SignUp;

use Core\Application\UseCases\Auth\SignUp\DTO\SignUpInputDto;
use Core\Application\UseCases\Auth\SignUp\DTO\SignUpOutputDto;

interface SignUpUseCaseInterface
{
    public function execute(SignUpInputDto $input): SignUpOutputDto;
}
