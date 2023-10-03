<?php

namespace Unit\Core\Application\UseCases\Auth;

use Core\Application\UseCases\Auth\LogoutUseCase;
use Core\Domain\Repository\AuthRepositoryInterface;
use Core\Intermediate\Dtos\Auth\LogoutInputDto;
use Tests\Fixtures\UserFixtures;
use Tests\TestCase;

class LogoutUseCaseUnitTest extends TestCase
{
    private function makeSut(): object
    {
        $repository = \Mockery::spy(AuthRepositoryInterface::class);
        $useCase = new LogoutUseCase(
            repository: $repository,
        );

        return (object)[
            'repository' => $repository,
            'useCase' => $useCase,
        ];
    }

    private function makeInputDto(): LogoutInputDto
    {
        return \Mockery::spy(LogoutInputDto::class, [ UserFixtures::UUID_MATHEUS ]);
    }

    public function testCallRepositoryMethodsWithCorrectValue()
    {
        $sut = $this->makeSut();
        $sut->useCase->execute(
            input: $this->makeInputDto()
        );

        $sut->repository->shouldHaveReceived('deleteTokensByUserId')->once()->with(UserFixtures::UUID_MATHEUS);
    }

    public function testThrowsMethodsIfThrows()
    {
        $this->expectException(\Exception::class);

        $sut = $this->makeSut();

        $sut->repository->shouldReceive('deleteTokensByUserId')->andThrow(new \Exception());
        $sut->useCase->execute(
            input: $this->makeInputDto()
        );
    }

    public function testLogoutSuccess()
    {
        $sut = $this->makeSut();
        $sut->repository->shouldReceive('deleteTokensByUserId')->andReturn(true);

        $response = $sut->useCase->execute(
            input: $this->makeInputDto()
        );

        $this->assertTrue($response->disconnected);
    }
}
