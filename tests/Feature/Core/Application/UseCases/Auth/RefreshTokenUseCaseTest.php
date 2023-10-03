<?php

namespace Feature\Core\Application\UseCases\Auth;

use App\Models\User;
use Core\Application\UseCases\Auth\RefreshTokenUseCase;
use Core\Domain\Repository\AuthRepositoryInterface;
use Core\Domain\UseCases\Auth\RefreshTokenUseCaseInterface;
use Core\Intermediate\Dtos\Auth\RefreshTokenInputDto;
use Illuminate\Support\Facades\Hash;
use Tests\Fixtures\UserFixtures;
use Tests\TestCase;

class RefreshTokenUseCaseTest extends TestCase
{
    private function makeSut(): RefreshTokenUseCaseInterface
    {
        return new RefreshTokenUseCase(
            repository: $this->app->make(AuthRepositoryInterface::class)
        );
    }

    private function makeInputDto(): RefreshTokenInputDto
    {
        return new RefreshTokenInputDto(
            id: UserFixtures::UUID_MATHEUS
        );
    }

    public function testRefreshTokenSuccess()
    {
        User::factory()->create([
            'id' => UserFixtures::UUID_MATHEUS,
            'email' => UserFixtures::EMAIL_MATHEUS,
            'password' => Hash::make(UserFixtures::DEFAULT_PASSWORD)
        ]);

        $useCase = $this->makeSut();
        $response = $useCase->execute(
            input: $this->makeInputDto()
        );

        $this->assertNotEmpty($response->accessToken);
        $this->assertEquals('Bearer', $response->tokenType);
    }
}
