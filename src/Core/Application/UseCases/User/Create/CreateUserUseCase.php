<?php

namespace Core\Application\UseCases\User\Create;

use Core\Application\UseCases\Interfaces\HasherInterface;
use Core\Application\UseCases\User\Create\DTO\SignUpInputDto;
use Core\Application\UseCases\User\Create\DTO\SignUpOutputDto;
use Core\Domain\Entity\User;
use Core\Domain\Exception\NotificationException;
use Core\Domain\Repository\UserRepositoryInterface;

class CreateUserUseCase implements CreateUserUseCaseInterface
{
    public function __construct(
        protected UserRepositoryInterface $repository,
        protected HasherInterface $hasher
    ) {
    }

    /**
     * @throws NotificationException
     */
    public function execute(SignUpInputDto $input): SignUpOutputDto
    {
        $entity = new User(
            firstName: $input->firstName,
            lastName: $input->lastName,
            email: $input->email
        );

        $hashedPassword = $this->hasher->hash( $input->password);
        $entity->updatePassword($hashedPassword);

        $result = $this->repository->insert($entity);

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
