<?php

namespace Core\Application\UseCases\Auth;

use Core\Domain\Exception\CredentialIncorrectException;
use Core\Domain\Repository\AuthRepositoryInterface;
use Core\Domain\Services\HasherInterface;
use Core\Domain\UseCases\Auth\SignInUseCaseInterface;
use Core\Intermediate\Dtos\Auth\SignInInputDto;
use Core\Intermediate\Dtos\Auth\SignInOutputDto;

class SignInUseCase implements SignInUseCaseInterface
{
    public function __construct(
        protected AuthRepositoryInterface $repository,
        protected HasherInterface $hasher
    ) {
    }

    /**
     * @throws \Exception
     */
    public function execute(SignInInputDto $input): SignInOutputDto
    {
        $user = $this->repository->findByEmail($input->email);

        $this->comparePassword($input->password, $user->password);
        $token = $this->repository->createTokenByUserId(
            id: $user->id
        );

        return new SignInOutputDto(
            accessToken: $token,
            tokenType: 'Bearer'
        );
    }

    /**
     * @throws \Exception
     */
    private function comparePassword(string $plaintext, string $hashed): void
    {
        if (! $this->hasher->compare($plaintext, $hashed)) {
            throw new CredentialIncorrectException(trans('auth.failed'));
        }
    }
}
