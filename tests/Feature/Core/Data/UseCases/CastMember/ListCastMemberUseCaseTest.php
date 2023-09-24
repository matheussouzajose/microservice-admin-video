<?php

namespace Feature\Core\Data\UseCases\CastMember;

use App\Models\CastMember as Model;
use App\Repositories\Eloquent\CastMemberEloquentRepository;
use Core\Data\UseCases\CastMember\List\DTO\ListCastMemberInputDto;
use Core\Data\UseCases\CastMember\List\ListCastMemberUseCase;
use Tests\TestCase;

class ListCastMemberUseCaseTest extends TestCase
{
    public function testFindById()
    {
        $useCase = new ListCastMemberUseCase(
            new CastMemberEloquentRepository(new Model())
        );

        $castMember = Model::factory()->create();

        $responseUseCase = $useCase->execute(new ListCastMemberInputDto(
            id: $castMember->id
        ));

        $this->assertEquals($castMember->id, $responseUseCase->id);
        $this->assertEquals($castMember->name, $responseUseCase->name);
    }
}
