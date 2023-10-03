<?php

namespace Core\Application\UseCases\Auth;

use Core\Domain\Exception\CredentialIncorrectException;
use Core\Domain\Repository\AuthRepositoryInterface;
use Core\Domain\UseCases\Auth\LogoutUseCaseInterface;
use Core\Intermediate\Dtos\Auth\LogoutInputDto;
use Core\Intermediate\Dtos\Auth\LogoutOutputDto;

class LogoutUseCase implements LogoutUseCaseInterface
{
    public function __construct(protected AuthRepositoryInterface $repository)
    {
    }

    public function execute(LogoutInputDto $input): LogoutOutputDto
    {
        $disconnected = $this->repository->deleteTokensByUserId($input->id);
        return new LogoutOutputDto(
            disconnected: $disconnected
        );
    }
}
