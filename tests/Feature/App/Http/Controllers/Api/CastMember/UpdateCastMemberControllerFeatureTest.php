<?php

namespace Feature\App\Http\Controllers\Api\CastMember;

use App\Http\Controllers\Api\CastMember\UpdateCastMemberController;
use App\Http\Requests\UpdateCastMemberRequest;
use App\Models\CastMember;
use App\Repositories\Eloquent\CastMemberEloquentRepository;
use Core\Application\UseCases\CastMember\UpdateCastMemberUseCase;
use Core\Domain\Exception\EntityValidationException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class UpdateCastMemberControllerFeatureTest extends TestCase
{
    protected CastMemberEloquentRepository $repository;

    protected function setUp(): void
    {
        $this->repository = new CastMemberEloquentRepository(
            new CastMember()
        );

        parent::setUp();
    }

    /**
     * @throws EntityValidationException
     */
    public function test_update()
    {
        $castMember = CastMember::factory()->create();

        $request = new UpdateCastMemberRequest();
        $request->headers->set('content-type', 'application/json');
        $request->setJson(new ParameterBag([
            'name' => 'Updated',
            'type' => 2,
        ]));

        $useCase = new UpdateCastMemberUseCase($this->repository);

        $response = (new UpdateCastMemberController($useCase))(
            request: $request,
            id: $castMember->id
        );

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(Response::HTTP_OK, $response->status());
        $this->assertDatabaseHas('cast_members', [
            'name' => 'Updated',
        ]);
    }
}
