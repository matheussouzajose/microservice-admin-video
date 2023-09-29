<?php

namespace Feature\Core\Application\UseCases\CastMember;

use App\Models\CastMember as Model;
use App\Repositories\Eloquent\CastMemberEloquentRepository;
use Core\Application\UseCases\CastMember\Delete\DeleteCastMemberUseCase;
use Core\Application\UseCases\CastMember\Delete\DTO\DeleteCastMemberInputDto;
use Tests\TestCase;

class DeleteCastMemberUseCaseTest extends TestCase
{
    public function testDelete()
    {
        $useCase = new DeleteCastMemberUseCase(
            new CastMemberEloquentRepository(new Model())
        );

        $castMember = Model::factory()->create();

        $responseUseCase = $useCase->execute(new DeleteCastMemberInputDto(
            id: $castMember->id
        ));

        $this->assertTrue($responseUseCase->success);

        $this->assertSoftDeleted('cast_members', [
            'id' => $castMember->id,
        ]);
    }
}
