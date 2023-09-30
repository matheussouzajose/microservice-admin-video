<?php

namespace Core\Application\UseCases\Auth\SignUp;

use Core\Application\UseCases\Auth\SignUp\DTO\SignUpInputDto;
use Core\Application\UseCases\Auth\SignUp\DTO\SignUpOutputDto;
use Core\Application\UseCases\Interfaces\HasherInterface;
use Core\Application\UseCases\Interfaces\TransactionInterface;
use Core\Application\UseCases\Interfaces\UserEventManagerInterface;
use Core\Domain\Entity\User;
use Core\Domain\Event\UserCreatedEvent;
use Core\Domain\Exception\EmailAlreadyInUseException;
use Core\Domain\Exception\NotificationException;
use Core\Domain\Repository\AuthRepositoryInterface;

class SignUpUseCase implements SignUpUseCaseInterface
{
    public function __construct(
        protected AuthRepositoryInterface $repository,
        protected HasherInterface $hasher,
        protected UserEventManagerInterface $eventManager,
        protected TransactionInterface $transaction
    ) {
    }

    /**
     * @throws EmailAlreadyInUseException
     * @throws NotificationException
     * @throws \Throwable
     */
    public function execute(SignUpInputDto $input): SignUpOutputDto
    {
        try {
            $this->verifyExistsEmail(
                email: $input->email
            );

            $entity = new User(
                firstName: $input->firstName,
                lastName: $input->lastName,
                email: $input->email
            );

            $hashedPassword = $this->hasher->hash(
                plaintext: $input->password
            );

            $entity->updatePassword(
                password: $hashedPassword
            );

            $result = $this->repository->signUp(
                entity: $entity
            );

            $this->eventManager->dispatch(
                event: new UserCreatedEvent($entity)
            );

            $this->transaction->commit();

            return new SignUpOutputDto(
                id: $result->id(),
                firstName: $result->firstName,
                lastName: $result->lastName,
                email: $result->email,
                createdAt: $result->createdAt()
            );
        } catch (\Throwable $th) {
            $this->transaction->rollback();
            throw $th;
        }
    }

    /**
     * @throws EmailAlreadyInUseException
     */
    private function verifyExistsEmail(string $email): void
    {
        $exists = $this->repository->checkByEmail(
            email: $email
        );

        if ($exists) {
            throw new EmailAlreadyInUseException(
                'Email already in use'
            );
        }
    }
}
