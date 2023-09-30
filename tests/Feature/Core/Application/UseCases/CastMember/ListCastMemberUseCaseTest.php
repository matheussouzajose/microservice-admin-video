<?php

namespace Feature\Core\Application\UseCases\CastMember;

use App\Models\CastMember as Model;
use App\Repositories\Eloquent\CastMemberEloquentRepository;
use Core\Application\UseCases\CastMember\ListCastMemberUseCase;
use Core\Intermediate\Dtos\CastMember\ListCastMemberInputDto;
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
