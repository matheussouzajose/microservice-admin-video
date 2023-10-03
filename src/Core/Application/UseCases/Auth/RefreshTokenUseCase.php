<?php

namespace Core\Application\UseCases\Auth;

use Core\Domain\Repository\AuthRepositoryInterface;
use Core\Domain\UseCases\Auth\RefreshTokenUseCaseInterface;
use Core\Intermediate\Dtos\Auth\RefreshTokenInputDto;
use Core\Intermediate\Dtos\Auth\RefreshTokenOutputDto;

class RefreshTokenUseCase implements RefreshTokenUseCaseInterface
{
    public function __construct(
        protected AuthRepositoryInterface $repository
    ) {
    }

    public function execute(RefreshTokenInputDto $input): RefreshTokenOutputDto
    {
        $this->repository->deleteTokensByUserId(
            id: $input->id
        );

        $result = $this->repository->createTokenByUserId(
            id: $input->id
        );

        return new RefreshTokenOutputDto(
            accessToken: $result,
            tokenType: 'Bearer'
        );
    }
}
