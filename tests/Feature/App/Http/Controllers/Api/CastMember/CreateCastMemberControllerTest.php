<?php

namespace Feature\App\Http\Controllers\Api\CastMember;

use App\Http\Controllers\Api\CastMember\CreateCastMemberController;
use App\Http\Requests\StoreCastMemberRequest;
use App\Models\CastMember;
use App\Repositories\Eloquent\CastMemberEloquentRepository;
use Core\Application\UseCases\CastMember\CreateCastMemberUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class CreateCastMemberControllerTest extends TestCase
{
    protected CastMemberEloquentRepository $repository;

    protected function setUp(): void
    {
        $this->repository = new CastMemberEloquentRepository(
            new CastMember()
        );

        parent::setUp();
    }

    public function testCreate()
    {
        $useCase = new CreateCastMemberUseCase($this->repository);

        $request = new StoreCastMemberRequest();
        $request->headers->set('content-type', 'application/json');
        $request->setJson(new ParameterBag([
            'name' => 'Teste',
            'type' => 1,
        ]));

        $response = (new CreateCastMemberController($useCase))($request);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(Response::HTTP_CREATED, $response->status());
    }
}
