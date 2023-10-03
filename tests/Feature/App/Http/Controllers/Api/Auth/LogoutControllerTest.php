<?php

namespace Feature\App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\Auth\LogoutController;
use App\Models\User;
use App\Repositories\Eloquent\AuthEloquentRepository;
use Core\Application\UseCases\Auth\LogoutUseCase;
use Core\Domain\UseCases\Auth\LogoutUseCaseInterface;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tests\Fixtures\UserFixtures;
use Tests\TestCase;

class LogoutControllerTest extends TestCase
{
    public function testLogoutSuccess()
    {
        $useCase = $this->makeUseCase();
        $request = $this->makeRequest();

        $response = (new LogoutController($useCase))($request);
        $this->assertEquals(Response::HTTP_NO_CONTENT, $response->status());
    }

    private function makeUseCase(): LogoutUseCaseInterface
    {
        $repository = new AuthEloquentRepository(
            model: new User()
        );

        return new LogoutUseCase(
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
