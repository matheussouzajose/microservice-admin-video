<?php

namespace Core\Domain\UseCases\Auth;

use Core\Intermediate\Dtos\Auth\SignUpInputDto;
use Core\Intermediate\Dtos\Auth\SignUpOutputDto;

interface SignUpUseCaseInterface
{
    public function execute(SignUpInputDto $input): SignUpOutputDto;
}
