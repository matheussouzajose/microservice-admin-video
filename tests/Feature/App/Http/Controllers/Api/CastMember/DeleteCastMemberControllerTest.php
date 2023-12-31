<?php

namespace Feature\App\Http\Controllers\Api\CastMember;

use App\Http\Controllers\Api\CastMember\DeleteCastMemberController;
use App\Models\CastMember;
use App\Repositories\Eloquent\CastMemberEloquentRepository;
use Core\Application\UseCases\CastMember\DeleteCastMemberUseCase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class DeleteCastMemberControllerTest extends TestCase
{
    protected CastMemberEloquentRepository $repository;

    protected function setUp(): void
    {
        $this->repository = new CastMemberEloquentRepository(
            new CastMember()
        );

        parent::setUp();
    }

    public function testDelete()
    {
        $castMember = CastMember::factory()->create();
        $useCase = new DeleteCastMemberUseCase($this->repository);

        $response = (new DeleteCastMemberController($useCase))(
            id: $castMember->id
        );

        $this->assertEquals(Response::HTTP_NO_CONTENT, $response->status());
    }
}
