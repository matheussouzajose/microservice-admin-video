<?php

namespace Tests\Unit\Core\Application\Mocks;

use Core\Application\UseCases\Auth\SignUpUseCase;
use Core\Application\UseCases\Interfaces\HasherInterface;
use Core\Application\UseCases\Interfaces\TransactionInterface;
use Core\Application\UseCases\Interfaces\UserEventManagerInterface;
use Core\Domain\Repository\AuthRepositoryInterface;
use Core\Domain\UseCases\Auth\SignUpUseCaseInterface;

class SignUpUseCaseMock
{
    protected $useCase;

    protected $repository;

    protected $hasher;

    protected $eventManager;

    protected $transaction;

    public function getUseCase(): SignUpUseCaseInterface
    {
        return $this->useCase;
    }

    public function getRepository(): AuthRepositoryInterface
    {
        return $this->repository;
    }

    public function getHasher(): HasherInterface
    {
        return $this->hasher;
    }

    public function getEventManager(): UserEventManagerInterface
    {
        return $this->eventManager;
    }

    public function getTransaction(): TransactionInterface
    {
        return $this->transaction;
    }

    public function make(): self
    {
        $repository = $this->createRepository();
        $hasher = $this->createHasher();
        $eventManager = $this->createUserEvent();
        $transaction = $this->createTransaction();

        $useCase = new SignUpUseCase(
            repository: $repository,
            hasher: $hasher,
            eventManager: $eventManager,
            transaction: $transaction,
        );

        $this->repository = $repository;
        $this->hasher = $hasher;
        $this->eventManager = $eventManager;
        $this->transaction = $transaction;
        $this->useCase = $useCase;

        return $this;
    }

    private function createRepository(): AuthRepositoryInterface
    {
        return \Mockery::spy(AuthRepositoryInterface::class);
    }

    private function createHasher(): HasherInterface
    {
        return \Mockery::spy(HasherInterface::class);
    }

    private function createUserEvent(): UserEventManagerInterface
    {
        return \Mockery::spy(UserEventManagerInterface::class);
    }

    private function createTransaction(): TransactionInterface
    {
        return \Mockery::spy(TransactionInterface::class);
    }
}
