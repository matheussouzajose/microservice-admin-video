<?php

namespace Feature\App\Http\Controllers\Api\CastMember;

use App\Http\Controllers\Api\CastMember\PaginateCastMembersController;
use App\Models\CastMember;
use App\Repositories\Eloquent\CastMemberEloquentRepository;
use Core\Application\UseCases\CastMember\PaginateCastMembersUseCase;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Tests\TestCase;

class ListCastMembersControllerTest extends TestCase
{
    protected CastMemberEloquentRepository $repository;

    protected function setUp(): void
    {
        $this->repository = new CastMemberEloquentRepository(
            new CastMember()
        );

        parent::setUp();
    }

    public function test_index()
    {
        $useCase = new PaginateCastMembersUseCase($this->repository);

        $response = (new PaginateCastMembersController($useCase))(new Request());

        $this->assertInstanceOf(AnonymousResourceCollection::class, $response);
        $this->assertArrayHasKey('meta', $response->additional);
    }
}
