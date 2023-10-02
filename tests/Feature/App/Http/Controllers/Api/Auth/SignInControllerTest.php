<?php

namespace Feature\App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\Auth\SignInController;
use App\Http\Requests\SignInRequest;
use App\Models\User;
use App\Repositories\Eloquent\AuthEloquentRepository;
use App\Services\Criptography\Hasher;
use Core\Application\UseCases\Auth\SignInUseCase;
use Core\Domain\UseCases\Auth\SignInUseCaseInterface;
use Database\Seeders\DatabaseSeeder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Response;
use Tests\Fixtures\UserFixtures;
use Tests\TestCase;

class SignInControllerTest extends TestCase
{
    public function testSignUpSuccess()
    {
        $useCase = $this->makeUseCase();
        $request = $this->makeRequest();

        $response = (new SignInController($useCase))($request);
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(Response::HTTP_OK, $response->status());
    }

    private function makeUseCase(): SignInUseCaseInterface
    {
        $repository = new AuthEloquentRepository(
            model: new User()
        );

        return new SignInUseCase(
            repository: $repository,
            hasher: new Hasher()
        );
    }

    private function makeRequest(): SignInRequest
    {
        $seeder = new DatabaseSeeder();
        $seeder->run();

        $request = new SignInRequest();
        $request->headers->set('content-type', 'application/json');
        $request->setJson(
            new ParameterBag([
                'email' => UserFixtures::EMAIL_MATHEUS,
                'password' => UserFixtures::DEFAULT_PASSWORD
            ])
        );

        return $request;
    }
}
