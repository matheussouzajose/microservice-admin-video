<?php

namespace Tests\Unit\Core\Application\UseCases\User;

use Core\Application\UseCases\Interfaces\HasherInterface;
use Core\Application\UseCases\User\Create\CreateUserUseCase;
use Core\Application\UseCases\User\Create\CreateUserUseCaseInterface;
use Core\Application\UseCases\User\Create\DTO\CreateUserInputDto;
use Core\Domain\Entity\User;
use Core\Domain\Repository\UserRepositoryInterface;
use Tests\TestCase;

class CreateUserUseCaseUnitTest extends TestCase
{
    private function createEntity(): User
    {
        return new User(
            firstName: 'Matheus',
            lastName: 'Jose',
            email: 'matheus.jose@mail.com',
            emailVerifiedAt: null
        );
    }

    private function createInputDto(): CreateUserInputDto
    {
        $input = ['Matheus', 'Jose', 'matheus.jose@gmail.com', '123456789'];
        return \Mockery::mock(CreateUserInputDto::class, $input);
    }

    private function createUseCase(UserRepositoryInterface $repository, HasherInterface $hasher): CreateUserUseCaseInterface
    {
        return new CreateUserUseCase(
            repository: $repository,
            hasher: $hasher
        );
    }

    public function testThrowsIfUserRepositoryThrows()
    {
        $this->expectException(\Exception::class);

        $repository = \Mockery::mock(\stdClass::class, UserRepositoryInterface::class);
        $repository->shouldReceive('insert')->andThrow(new \Exception());

        $hash = \Mockery::mock(\stdClass::class, HasherInterface::class);

        $useCase = $this->createUseCase($repository, $hash);
        $useCase->execute($this->createInputDto());
    }

    public function testThrowsIfHasherThrows()
    {
        $this->expectException(\Exception::class);

        $repository = \Mockery::mock(\stdClass::class, UserRepositoryInterface::class);

        $hash = \Mockery::mock(\stdClass::class, HasherInterface::class);
        $hash->shouldReceive('hash')->andThrow(new \Exception());

        $useCase = $this->createUseCase($repository, $hash);
        $useCase->execute($this->createInputDto());
    }

    public function testCreateUserSuccess()
    {
        $entity = $this->createEntity();
        $repository = \Mockery::mock(\stdClass::class, UserRepositoryInterface::class);
        $repository->shouldReceive('insert')->times(1)->andReturn($entity);

        $hash = \Mockery::mock(\stdClass::class, HasherInterface::class);
        $hash->shouldReceive('hash')->times(1)->andReturn('hashed_value');

        $useCase = $this->createUseCase($repository, $hash);
        $response = $useCase->execute($this->createInputDto());

        $this->assertNotEmpty($response->id);
        $this->assertEquals($entity->firstName, $response->firstName);
        $this->assertEquals($entity->lastName, $response->lastName);
        $this->assertEquals($entity->email, $response->email);
        $this->assertNotEmpty($response->createdAt);
        $this->assertNull($response->emailVerifiedAt);
    }
}
