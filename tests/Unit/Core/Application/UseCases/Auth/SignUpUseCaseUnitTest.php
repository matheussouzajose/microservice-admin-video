<?php

namespace Unit\Core\Application\UseCases\Auth;

use Core\Application\UseCases\Auth\SignUp\DTO\SignUpInputDto;
use Core\Application\UseCases\Auth\SignUp\SignUpUseCase;
use Core\Application\UseCases\Interfaces\HasherInterface;
use Core\Domain\Entity\User;
use Core\Domain\Repository\AuthRepositoryInterface;
use Core\Domain\Repository\UserRepositoryInterface;
use Tests\TestCase;

class SignUpUseCaseUnitTest extends TestCase
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

    private function createInputDto(): SignUpInputDto
    {
        $input = ['Matheus', 'Jose', 'matheus.jose@gmail.com', '123456789'];
        return \Mockery::mock(SignUpInputDto::class, $input);
    }

    private function createUseCase(AuthRepositoryInterface $repository, HasherInterface $hasher): SignUpUseCase
    {
        return new SignUpUseCase(
            repository: $repository,
            hasher: $hasher
        );
    }

    public function testThrowsIfSignUpThrows()
    {
        $this->expectException(\Exception::class);

        $repository = \Mockery::mock(\stdClass::class, AuthRepositoryInterface::class);
        $repository->shouldReceive('signUp')->andThrow(new \Exception());

        $hash = \Mockery::mock(\stdClass::class, HasherInterface::class);

        $useCase = $this->createUseCase($repository, $hash);
        $useCase->execute($this->createInputDto());
    }

    public function testThrowsIfHasherThrows()
    {
        $this->expectException(\Exception::class);

        $repository = \Mockery::mock(\stdClass::class, AuthRepositoryInterface::class);

        $hash = \Mockery::mock(\stdClass::class, HasherInterface::class);
        $hash->shouldReceive('hash')->andThrow(new \Exception());

        $useCase = $this->createUseCase($repository, $hash);
        $useCase->execute($this->createInputDto());
    }

    public function testSignUpSuccess()
    {
        $entity = $this->createEntity();
        $repository = \Mockery::mock(\stdClass::class, AuthRepositoryInterface::class);
        $repository->shouldReceive('signUp')->times(1)->andReturn($entity);

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
