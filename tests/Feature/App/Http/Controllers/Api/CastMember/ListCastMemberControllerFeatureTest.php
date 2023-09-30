<?php

namespace Feature\App\Http\Controllers\Api\CastMember;

use App\Http\Controllers\Api\CastMember\ListCastMemberController;
use App\Models\CastMember;
use App\Repositories\Eloquent\CastMemberEloquentRepository;
use Core\Application\UseCases\CastMember\ListCastMemberUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ListCastMemberControllerFeatureTest extends TestCase
{
    protected CastMemberEloquentRepository $repository;

    protected function setUp(): void
    {
        $this->repository = new CastMemberEloquentRepository(
            new CastMember()
        );

        parent::setUp();
    }

    public function testListCastMember()
    {
        $castMember = CastMember::factory()->create();
        $useCase = new ListCastMemberUseCase($this->repository);

        $response = (new ListCastMemberController($useCase))(
            id: $castMember->id,
        );

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(Response::HTTP_OK, $response->status());
    }
}
