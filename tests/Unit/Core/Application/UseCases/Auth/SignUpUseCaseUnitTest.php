<?php

namespace Tests\Unit\Core\Application\UseCases\Auth;

use Core\Application\UseCases\Auth\SignUpUseCase;
use Core\Domain\Event\Interfaces\UserEventManagerInterface;
use Core\Domain\Exception\EmailAlreadyInUseException;
use Core\Domain\Exception\NotificationException;
use Core\Domain\Repository\AuthRepositoryInterface;
use Core\Domain\Repository\TransactionInterface;
use Core\Domain\Services\HasherInterface;
use Core\Intermediate\Dtos\Auth\SignUpInputDto;
use Tests\Fixtures\CreateEntity;
use Tests\Fixtures\UserFixtures;
use Tests\TestCase;

class SignUpUseCaseUnitTest extends TestCase
{
    private function makeSut(): object
    {
        $repository = \Mockery::spy(AuthRepositoryInterface::class);
        $hasher = \Mockery::spy(HasherInterface::class);
        $eventManager = \Mockery::spy(UserEventManagerInterface::class);
        $transaction = \Mockery::spy(TransactionInterface::class);

        $useCase = new SignUpUseCase(
            repository: $repository,
            hasher: $hasher,
            eventManager: $eventManager,
            transaction: $transaction,
        );

        return (object)[
            'repository' => $repository,
            'hasher' => $hasher,
            'eventManager' => $eventManager,
            'transaction' => $transaction,
            'useCase' => $useCase,
        ];
    }

    private function makeInputDto(): SignUpInputDto
    {
        return \Mockery::spy(SignUpInputDto::class, [
            UserFixtures::FIRST_NAME_MATHEUS,
            UserFixtures::LAST_NAME_MATHEUS,
            UserFixtures::EMAIL_MATHEUS,
            UserFixtures::DEFAULT_PASSWORD,
        ]);
    }

    /**
     * @dataProvider  externalMethodWithValueProvider
     * @throws NotificationException
     */
    public function testCallExternalMethodsWithCorrectValue(string $external, string $method, ?string $value = null)
    {
        $sut = $this->makeSut();
        $this->applyDefaultValue($sut);

        $sut->useCase->execute(
            input: $this->makeInputDto()
        );

        $result = $sut->{$external}->shouldHaveReceived($method)->once();
        if (! empty($value)) {
            $result->with($value);
        }
    }

    public function externalMethodWithValueProvider(): array
    {
        return [
            ['repository', 'checkByEmail', UserFixtures::EMAIL_MATHEUS],
            ['hasher', 'hash', UserFixtures::DEFAULT_PASSWORD],
            ['repository', 'insert'],
            ['eventManager', 'dispatch'],
            ['transaction', 'commit'],
        ];
    }

    /**
     * @dataProvider  externalMethodProvider
     */
    public function testThrowsMethodsIfThrows(string $external, string $method)
    {
        $this->expectException(\Exception::class);

        $sut = $this->makeSut();
        $sut->{$external}->shouldReceive($method)->andThrow(new \Exception());
        $sut->useCase->execute(
            input: $this->makeInputDto()
        );

        $sut->transaction->shouldHaveReceived('roolback')->once();
    }

    public function externalMethodProvider(): array
    {
        return [
            ['repository', 'checkByEmail'],
            ['repository', 'insert'],
            ['hasher', 'hash'],
            ['eventManager', 'dispatch'],
            ['transaction', 'commit'],
        ];
    }

    public function testThrowsIfEmailAlreadyInUseThrows()
    {
        $this->expectException(EmailAlreadyInUseException::class);
        $this->expectExceptionMessage('Email already in use');

        $sut = $this->makeSut();
        $sut->repository->shouldReceive('checkByEmail')->andReturn(true);
        $sut->useCase->execute(
            input: $this->makeInputDto()
        );
    }

    /**
     * @throws NotificationException
     */
    public function testSignUpSuccess()
    {
        $sut = $this->makeSut();
        $this->applyDefaultValue($sut);

        $response = $sut->useCase->execute(
            input: $this->makeInputDto()
        );

        $this->assertNotEmpty($response->id);
        $this->assertEquals(UserFixtures::FIRST_NAME_MATHEUS, $response->firstName);
        $this->assertEquals(UserFixtures::LAST_NAME_MATHEUS, $response->lastName);
        $this->assertEquals(UserFixtures::EMAIL_MATHEUS, $response->email);
        $this->assertNotEmpty($response->createdAt);
    }

    /**
     * @throws NotificationException
     */
    private function applyDefaultValue(object $sut): void
    {
        $sut->repository->shouldReceive('insert')->andReturn(CreateEntity::loadUser());
    }
}
