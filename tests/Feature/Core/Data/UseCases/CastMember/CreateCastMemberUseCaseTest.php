<?php

namespace Tests\Feature\Core\Data\UseCases\CastMember;

use App\Models\CastMember as Model;
use App\Repositories\Eloquent\CastMemberEloquentRepository;
use Core\Data\UseCases\CastMember\Create\CreateCastMemberUseCase;
use Core\Data\UseCases\CastMember\Create\DTO\CreateCastMemberInputDto;
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
