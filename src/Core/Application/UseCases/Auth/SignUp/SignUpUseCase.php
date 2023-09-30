<?php

namespace Core\Application\UseCases\Auth\SignUp;

use Core\Application\UseCases\Auth\SignUp\DTO\SignUpInputDto;
use Core\Application\UseCases\Auth\SignUp\DTO\SignUpOutputDto;
use Core\Application\UseCases\Interfaces\HasherInterface;
use Core\Domain\Entity\User;
use Core\Domain\Repository\AuthRepositoryInterface;

class SignUpUseCase implements SignUpUseCaseInterface
{
    public function __construct(
        protected AuthRepositoryInterface $repository,
        protected HasherInterface $hasher
    ) {
    }

    public function execute(SignUpInputDto $input): SignUpOutputDto
    {
        $entity = new User(
            firstName: $input->firstName,
            lastName: $input->lastName,
            email: $input->email
        );

        $hashedPassword = $this->hasher->hash( $input->password);
        $entity->updatePassword($hashedPassword);

        $result = $this->repository->signUp($entity);

        return new SignUpOutputDto(
            id: $result->id(),
            firstName: $result->firstName,
            lastName: $result->lastName,
            email: $result->email,
            createdAt: $result->createdAt(),
            emailVerifiedAt: $result->emailVerifiedAt
        );
    }
}
