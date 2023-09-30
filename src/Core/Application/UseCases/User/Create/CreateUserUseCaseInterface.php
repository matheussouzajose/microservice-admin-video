<?php

namespace Core\Application\UseCases\User\Create;

use Core\Application\UseCases\User\Create\DTO\SignUpInputDto;
use Core\Application\UseCases\User\Create\DTO\SignUpOutputDto;

interface CreateUserUseCaseInterface
{
    public function execute(SignUpInputDto $input): SignUpOutputDto;
}
