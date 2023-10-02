<?php

namespace Tests\Feature\Core\Application\UseCases\CastMember;

use App\Models\CastMember as Model;
use App\Repositories\Eloquent\CastMemberEloquentRepository;
use Core\Application\UseCases\CastMember\CreateCastMemberUseCase;
use Core\Intermediate\Dtos\CastMember\CreateCastMemberInputDto;
use Tests\TestCase;

class CreateCastMemberUseCaseTest extends TestCase
{
    public function testInsert()
    {
        $repository = new CastMemberEloquentRepository(new Model());

        $useCase = new CreateCastMemberUseCase(
            $repository,
        );

        $useCase->execute(
            new CreateCastMemberInputDto(
                name: 'Cast Member',
                type: 1
            )
        );

        $this->assertDatabaseHas('cast_members', [
            'name' => 'Cast Member',
        ]);

    }
}
