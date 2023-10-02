<?php

namespace Feature\Core\Application\UseCases\Auth;

use App\Models\User;
use Core\Application\UseCases\Auth\SignInUseCase;
use Core\Domain\Repository\AuthRepositoryInterface;
use Core\Domain\UseCases\Auth\SignInUseCaseInterface;
use Core\Intermediate\Dtos\Auth\SignInInputDto;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Tests\Fixtures\UserFixtures;
use Tests\Stubs\HasherStub;
use Tests\TestCase;

class SignInUseCaseTest extends TestCase
{
    private function makeSut(): SignInUseCaseInterface
    {
        return new SignInUseCase(
            repository: $this->app->make(AuthRepositoryInterface::class),
            hasher: new HasherStub(),
        );
    }

    private function makeInputDto(): SignInInputDto
    {
        return new SignInInputDto(
            email: UserFixtures::EMAIL_MATHEUS,
            password: UserFixtures::DEFAULT_PASSWORD
        );
    }

    public function testThrowsHasherException()
    {
        $this->expectException(\Exception::class);

        Event::listen(HasherStub::class, function () {
            throw new \Exception();
        });

        $useCase = $this->makeSut();
        $useCase->execute(
            input: $this->makeInputDto()
        );
    }

    public function testSignInSuccess()
    {
        User::factory()->create([
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
