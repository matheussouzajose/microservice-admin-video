<?php

namespace Unit\Core\Application\UseCases\Auth;

use Core\Application\UseCases\Auth\SignInUseCase;
use Core\Domain\Entity\User;
use Core\Domain\Exception\CredentialIncorrectException;
use Core\Domain\Exception\NotificationException;
use Core\Domain\Repository\AuthRepositoryInterface;
use Core\Domain\Services\HasherInterface;
use Core\Domain\ValueObject\Image;
use Core\Domain\ValueObject\Uuid;
use Core\Intermediate\Dtos\Auth\SignInInputDto;
use Tests\Fixtures\UserFixtures;
use Tests\TestCase;

class SignInUseCaseUnitTest extends TestCase
{
    private function makeSut(): object
    {
        $repository = \Mockery::spy(AuthRepositoryInterface::class);
        $hasher = \Mockery::spy(HasherInterface::class);
        $useCase = new SignInUseCase(
            repository: $repository,
            hasher: $hasher
        );

        return (object)[
            'repository' => $repository,
            'hasher' => $hasher,
            'useCase' => $useCase,
        ];
    }

    /**
     * @throws NotificationException
     */
    private function makeEntity(): User
    {
        return new User(
            firstName: UserFixtures::FIRST_NAME_MATHEUS,
            lastName: UserFixtures::LAST_NAME_MATHEUS,
            email: UserFixtures::EMAIL_MATHEUS,
            password: 'hashed_password',
            userAvatar: new Image(UserFixtures::AVATAR_MATHEUS),
            id: new Uuid(UserFixtures::UUID_MATHEUS)
        );
    }

    private function makeInputDto(): SignInInputDto
    {
        return \Mockery::spy(SignInInputDto::class, [
            UserFixtures::EMAIL_MATHEUS,
            UserFixtures::DEFAULT_PASSWORD,
        ]);
    }

    /**
     * @throws NotificationException
     */
    public function testCallCompareCorrectValue()
    {
        $sut = $this->makeSut();
        $this->applyDefaultValue($sut);

        $sut->useCase->execute(
            input: $this->makeInputDto()
        );

        $sut->hasher->shouldHaveReceived('compare')
            ->once()
            ->with(UserFixtures::DEFAULT_PASSWORD, 'hashed_password');
    }

    private function applyDefaultValue($sut): void
    {
        $sut->repository->shouldReceive('findByEmail')->andReturn($this->makeEntity());
        $sut->repository->shouldReceive('createTokenByUserId')->andReturn('token');
        $sut->hasher->shouldReceive('compare')->andReturn(true);
    }

    /**
     * @dataProvider methodWithValueProvider
     * @throws NotificationException
     */
    public function testCallRepositoryMethodsWithCorrectValue(string $method, string $value)
    {
        $sut = $this->makeSut();
        $this->applyDefaultValue($sut);

        $sut->useCase->execute(
            input: $this->makeInputDto()
        );

        $sut->repository->shouldHaveReceived($method)->once()->with($value);
    }

    public function methodWithValueProvider(): array
    {
        return [
            ['findByEmail', UserFixtures::EMAIL_MATHEUS],
            ['createTokenByUserId', UserFixtures::UUID_MATHEUS],
        ];
    }

    /**
     * @dataProvider  externalMethodProvider
     * @throws NotificationException
     */
    public function testThrowsMethodsIfThrows(string $external, string $method)
    {
        $this->expectException(\Exception::class);

        $sut = $this->makeSut();
        $sut->repository->shouldReceive('findByEmail')->andReturn($this->makeEntity());

        $sut->{$external}->shouldReceive($method)->andThrow(new \Exception());
        $sut->useCase->execute(
            input: $this->makeInputDto()
        );
    }

    public function externalMethodProvider(): array
    {
        return [
            ['repository', 'findByEmail'],
            ['hasher', 'compare'],
            ['repository', 'createTokenById']
        ];
    }

    /**
     * @throws NotificationException
     */
    public function testSignInSuccess()
    {
        $sut = $this->makeSut();
        $this->applyDefaultValue($sut);

        $response = $sut->useCase->execute(
            input: $this->makeInputDto()
        );

        $this->assertEquals('token', $response->accessToken);
        $this->assertEquals('Bearer', $response->tokenType);
    }

    public function testCredentialIncorrectExceptionIfCompareIsFalse()
    {
        $this->expectException(CredentialIncorrectException::class);
        $this->expectExceptionMessage(trans('auth.failed'));

        $sut = $this->makeSut();
        $sut->repository->shouldReceive('findByEmail')->andReturn($this->makeEntity());
        $sut->hasher->shouldReceive('compare')->andReturn(false);

        $sut->useCase->execute(
            input: $this->makeInputDto()
        );
    }
}
