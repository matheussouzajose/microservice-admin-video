<?php

namespace Unit\Core\Application\UseCases\Auth;

use Core\Application\UseCases\Auth\RefreshTokenUseCase;
use Core\Domain\Repository\AuthRepositoryInterface;
use Core\Intermediate\Dtos\Auth\RefreshTokenInputDto;
use Tests\Fixtures\UserFixtures;
use Tests\TestCase;

class RefreshTokenUseCaseUnitTest extends TestCase
{
    private function makeSut(): object
    {
        $repository = \Mockery::spy(AuthRepositoryInterface::class);
        $useCase = new RefreshTokenUseCase(
            repository: $repository,
        );

        return (object)[
            'repository' => $repository,
            'useCase' => $useCase,
        ];
    }

    private function makeInputDto(): RefreshTokenInputDto
    {
        return \Mockery::spy(RefreshTokenInputDto::class, [ UserFixtures::UUID_MATHEUS ]);
    }

    /**
     * @dataProvider actionsProvider
     */
    public function testCallRepositoryMethodsWithCorrectValue(string $action)
    {
        $sut = $this->makeSut();
        $sut->useCase->execute(
            input: $this->makeInputDto()
        );

        $sut->repository->shouldHaveReceived($action)->once()->with(UserFixtures::UUID_MATHEUS);
    }

    /**
     * @dataProvider actionsProvider
     */
    public function testThrowsMethodsIfThrows(string $action)
    {
        $this->expectException(\Exception::class);

        $sut = $this->makeSut();

        $sut->repository->shouldReceive($action)->andThrow(new \Exception());
        $sut->useCase->execute(
            input: $this->makeInputDto()
        );
    }

    public function actionsProvider(): array
    {
        return [
            ['deleteTokensByUserId'],
            ['createTokenByUserId'],
        ];
    }

    public function testRefreshTokenSuccess()
    {
        $sut = $this->makeSut();
        $sut->repository->shouldReceive('deleteTokensByUserId')->andReturn(true);
        $sut->repository->shouldReceive('createTokenByUserId')->andReturn('auth_token');

        $response = $sut->useCase->execute(
            input: $this->makeInputDto()
        );

        $this->assertNotEmpty($response->accessToken);
        $this->assertEquals('Bearer', $response->tokenType);
    }
}
