<?php

namespace Tests\Unit\Core\Application\UseCases\Auth;

use Core\Application\UseCases\Auth\SignUp\DTO\SignUpInputDto;
use Core\Domain\Entity\User;
use Core\Domain\Exception\EmailAlreadyInUseException;
use Tests\TestCase;
use Tests\Unit\Core\Application\Mocks\SignUpUseCaseMock;

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
        return \Mockery::spy(SignUpInputDto::class, [
            'Matheus',
            'Jose',
            'matheus.jose@gmail.com',
            '123456789',
        ]);
    }

    /**
     * @dataProvider  externalMethodWithValueProvider
     */
    public function testCallExternalMethodsWithCorrectValue(string $external, string $method, string $value)
    {
        $sut = (new SignUpUseCaseMock())->make();
        $sut->getRepository()->shouldReceive('signUp')->andReturn($this->createEntity());

        $sut->getUseCase()->execute(
            input: $this->createInputDto()
        );

        $result = $sut->{$external}()->shouldHaveReceived($method)->once();
        if (! empty($value)) {
            $result->with($value);
        }
    }

    public function externalMethodWithValueProvider(): array
    {
        return [
            ['getRepository', 'checkByEmail', 'matheus.jose@gmail.com'],
            ['getHasher', 'hash', '123456789'],
            ['getRepository', 'signUp', ''],
            ['getEventManager', 'dispatch', ''],
            ['getTransaction', 'commit', ''],
        ];
    }

    /**
     * @dataProvider  externalMethodProvider
     */
    public function testThrowsMethodsIfThrows(string $external, string $method)
    {
        $this->expectException(\Exception::class);

        $sut = (new SignUpUseCaseMock())->make();
        $sut->{$external}()->shouldReceive($method)->andThrow(new \Exception());
        $sut->getUseCase()->execute(
            input: $this->createInputDto()
        );

        $sut->getTransaction()->shouldHaveReceived('roolback')->once();
    }

    public function externalMethodProvider(): array
    {
        return [
            ['getRepository', 'checkByEmail'],
            ['getRepository', 'signUp'],
            ['getHasher', 'hash'],
            ['getEventManager', 'dispatch'],
            ['getTransaction', 'commit'],
        ];
    }

    public function testThrowsIfEmailAlreadyInUseThrows()
    {
        $this->expectException(EmailAlreadyInUseException::class);
        $this->expectExceptionMessage('Email already in use');

        $sut = (new SignUpUseCaseMock())->make();

        $sut->getRepository()->shouldReceive('checkByEmail')->andReturn(true);

        $sut->getUseCase()->execute(
            input: $this->createInputDto()
        );
    }

    public function testSignUpSuccess()
    {
        $sut = (new SignUpUseCaseMock())->make();
        $entity = $this->createEntity();
        $sut->getRepository()->shouldReceive('signUp')->andReturn($entity);

        $response = $sut->getUseCase()->execute(
            input: $this->createInputDto()
        );

        $this->assertNotEmpty($response->id);
        $this->assertEquals($entity->firstName, $response->firstName);
        $this->assertEquals($entity->lastName, $response->lastName);
        $this->assertEquals($entity->email, $response->email);
        $this->assertNotEmpty($response->createdAt);
    }
}
