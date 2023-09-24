<?php

namespace Feature\Core\Data\UseCases\CastMember;

use App\Models\CastMember;
use App\Repositories\Eloquent\CastMemberEloquentRepository;
use Core\Data\UseCases\CastMember\Paginate\DTO\PaginateCastMembersInputDto;
use Core\Data\UseCases\CastMember\Paginate\PaginateCastMembersUseCase;
use Tests\TestCase;

class PaginateCastMembersUseCaseTest extends TestCase
{
    public function testFindAll()
    {
        $useCase = new PaginateCastMembersUseCase(
            new CastMemberEloquentRepository(new CastMember())
        );

        CastMember::factory()->count(100)->create();

        $responseUseCase = $useCase->execute(
            new PaginateCastMembersInputDto()
        );

        $this->assertEquals(15, count($responseUseCase->items()));
        $this->assertEquals(100, $responseUseCase->total());
    }
}
