<?php

namespace Feature\Core\Application\UseCases\Auth;

use App\Models\User;
use Core\Application\UseCases\Auth\LogoutUseCase;
use Core\Domain\Repository\AuthRepositoryInterface;
use Core\Domain\UseCases\Auth\LogoutUseCaseInterface;
use Core\Intermediate\Dtos\Auth\LogoutInputDto;
use Illuminate\Support\Facades\Hash;
use Tests\Fixtures\UserFixtures;
use Tests\TestCase;

class LogoutUseCaseTest extends TestCase
{
    private function makeSut(): LogoutUseCaseInterface
    {
        return new LogoutUseCase(
            repository: $this->app->make(AuthRepositoryInterface::class)
        );
    }

    private function makeInputDto(): LogoutInputDto
    {
        return new LogoutInputDto(
            id: UserFixtures::UUID_MATHEUS
        );
    }

    public function testLogoutSuccess()
    {
        $user = User::factory()->create([
            'id' => UserFixtures::UUID_MATHEUS,
            'email' => UserFixtures::EMAIL_MATHEUS,
            'password' => Hash::make(UserFixtures::DEFAULT_PASSWORD)
        ]);
        $user->createToken('authtoken');

        $useCase = $this->makeSut();
        $response = $useCase->execute(
            input: $this->makeInputDto()
        );

        $this->assertTrue($response->disconnected);
    }
}
