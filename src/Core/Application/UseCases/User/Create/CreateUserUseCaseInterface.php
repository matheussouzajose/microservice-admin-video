<?php

namespace Core\Application\UseCases\User\Create;

use Core\Application\UseCases\User\Create\DTO\CreateUserInputDto;
use Core\Application\UseCases\User\Create\DTO\CreateUserOutputDto;

interface CreateUserUseCaseInterface
{
    public function execute(CreateUserInputDto $input): CreateUserOutputDto;
}
