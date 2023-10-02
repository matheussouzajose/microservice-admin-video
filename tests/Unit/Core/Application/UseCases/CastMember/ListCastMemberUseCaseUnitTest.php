<?php

namespace Tests\Unit\Core\Application\UseCases\CastMember;

use Core\Application\UseCases\CastMember\ListCastMemberUseCase;
use Core\Domain\Entity\CastMember as EntityCastMember;
use Core\Domain\Enum\CastMemberType;
use Core\Domain\Repository\CastMemberRepositoryInterface;
use Core\Domain\ValueObject\Uuid;
use Core\Intermediate\Dtos\CastMember\ListCastMemberInputDto;
use Core\Intermediate\Dtos\CastMember\ListCastMemberOutputDto;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid as RamseyUuid;

class ListCastMemberUseCaseUnitTest extends TestCase
{
    public function testList()
    {
        $uuid = (string) RamseyUuid::uuid4();

        // arrange
        $mockEntity = \Mockery::mock(EntityCastMember::class, [
            'name',
            CastMemberType::ACTOR,
            new Uuid($uuid),
        ]);
        $mockEntity->shouldReceive('id')->andReturn($uuid);
        $mockEntity->shouldReceive('createdAt')->andReturn(date('Y-m-d H:i:s'));

        $mockRepository = \Mockery::mock(\stdClass::class, CastMemberRepositoryInterface::class);
        $mockRepository->shouldReceive('findById')
            ->times(1)
            ->with($uuid)
            ->andReturn($mockEntity);

        $mockInputDTO = \Mockery::mock(ListCastMemberInputDto::class, [$uuid]);

        $useCase = new ListCastMemberUseCase($mockRepository);
        $response = $useCase->execute($mockInputDTO);

        $this->assertInstanceOf(ListCastMemberOutputDto::class, $response);

        \Mockery::close();
    }
}
