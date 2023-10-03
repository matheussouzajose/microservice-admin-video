<?php

namespace Feature\App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\Auth\RefreshTokenController;
use App\Models\User;
use App\Repositories\Eloquent\AuthEloquentRepository;
use Core\Application\UseCases\Auth\RefreshTokenUseCase;
use Core\Domain\UseCases\Auth\RefreshTokenUseCaseInterface;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Tests\Fixtures\UserFixtures;
use Tests\TestCase;

class RefreshTokenControllerTest extends TestCase
{
    public function testLogoutSuccess()
    {
        $useCase = $this->makeUseCase();
        $request = $this->makeRequest();

        $response = (new RefreshTokenController($useCase))($request);
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(Response::HTTP_OK, $response->status());
    }

    private function makeUseCase(): RefreshTokenUseCaseInterface
    {
        $repository = new AuthEloquentRepository(
            model: new User()
        );

        return new RefreshTokenUseCase(
            repository: $repository
        );
    }

    private function makeRequest(): Request
    {
        $user = User::factory()->create([
            'id' => UserFixtures::UUID_MATHEUS,
            'email' => UserFixtures::EMAIL_MATHEUS
        ]);

        $request = new Request();
        $request->headers->set('content-type', 'application/json');
        $request->setUserResolver(function () use ($user) {
            return $user;
        });

        return $request;
    }
}
