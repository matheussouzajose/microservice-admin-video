<?php

namespace Feature\Core\Application\UseCases\CastMember;

use App\Models\CastMember as Model;
use App\Repositories\Eloquent\CastMemberEloquentRepository;
use Core\Application\UseCases\CastMember\UpdateCastMemberUseCase;
use Core\Intermediate\Dtos\CastMember\UpdateCastMemberInputDto;
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
