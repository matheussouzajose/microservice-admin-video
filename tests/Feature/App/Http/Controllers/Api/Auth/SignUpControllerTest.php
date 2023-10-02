<?php

namespace Feature\App\Http\Controllers\Api\Auth;

use App\Events\UserEventManager;
use App\Http\Controllers\Api\Auth\SignUpController;
use App\Http\Requests\StoreSignUpRequest;
use App\Models\User;
use App\Repositories\Eloquent\AuthEloquentRepository;
use App\Repositories\Transaction\DBTransaction;
use App\Services\Criptography\Hasher;
use Core\Application\UseCases\Auth\SignUpUseCase;
use Core\Domain\UseCases\Auth\SignUpUseCaseInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class SignUpControllerTest extends TestCase
{
    public function testSignUpSuccess()
    {
        $useCase = $this->makeUseCase();
        $request = $this->makeRequest();

        $response = (new SignUpController($useCase))($request);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(Response::HTTP_CREATED, $response->status());
    }

    private function makeUseCase(): SignUpUseCaseInterface
    {
        $repository = new AuthEloquentRepository(
            model: new User()
        );

        return new SignUpUseCase(
            repository: $repository,
            hasher: new Hasher(),
            eventManager: new UserEventManager(),
            transaction: new DBTransaction()
        );
    }

    private function makeRequest(): StoreSignUpRequest
    {
        $request = new StoreSignUpRequest();
        $request->headers->set('content-type', 'application/json');
        $request->setJson(
            new ParameterBag([
                'first_name' => 'Antonio',
                'last_name' => 'Jose',
                'email' => 'antonio.jose@mail.com',
                'password' => '123456789'
            ])
        );

        return $request;
    }
}
