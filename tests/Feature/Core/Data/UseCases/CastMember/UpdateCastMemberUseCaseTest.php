<?php

namespace Feature\Core\Data\UseCases\CastMember;

use App\Models\CastMember as Model;
use App\Repositories\Eloquent\CastMemberEloquentRepository;
use Core\Data\UseCases\CastMember\Update\DTO\UpdateCastMemberInputDto;
use Core\Data\UseCases\CastMember\Update\UpdateCastMemberUseCase;
use Tests\TestCase;

class UpdateCastMemberUseCaseTest extends TestCase
{
    public function testUpdate()
    {
        $repository = new CastMemberEloquentRepository(new Model());

        $useCase = new UpdateCastMemberUseCase(
            $repository
        );

        $genre = Model::factory()->create();

        $useCase->execute(
            new UpdateCastMemberInputDto(
                id: $genre->id,
                name: 'New Name'
            )
        );

        $this->assertDatabaseHas('cast_members', [
            'name' => 'New Name',
        ]);
    }
}
