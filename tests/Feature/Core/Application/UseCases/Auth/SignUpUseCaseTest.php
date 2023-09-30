<?php

namespace Feature\Core\Application\UseCases\Auth;

use Core\Application\UseCases\Auth\SignUp\DTO\SignUpInputDto;
use Core\Application\UseCases\Auth\SignUp\SignUpUseCase;
use Core\Application\UseCases\Interfaces\HasherInterface;
use Core\Domain\Repository\AuthRepositoryInterface;
use Tests\TestCase;

class SignUpUseCaseTest extends TestCase
{
    public function testSignUpSuccess()
    {
        $repository = $this->app->make(AuthRepositoryInterface::class);
        $hasher = $this->app->make(HasherInterface::class);

        $input = new SignUpInputDto(
            firstName: 'Matheus',
            lastName: 'Jose',
            email: 'matheus.jose@gmail.com',
            password: '123456789'
        );

        $useCase = new SignUpUseCase($repository, $hasher);
        $result = $useCase->execute($input);

        $this->assertNotEmpty($result->id);
        $this->assertNotEmpty($result->createdAt);
        $this->assertEquals('Matheus', $result->firstName);
        $this->assertEquals('Jose', $result->lastName);
        $this->assertEquals('matheus.jose@gmail.com', $result->email);
    }
}
