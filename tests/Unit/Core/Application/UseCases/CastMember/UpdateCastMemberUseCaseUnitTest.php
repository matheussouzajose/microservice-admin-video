<?php

namespace Tests\Unit\Core\Application\UseCases\CastMember;

use Core\Application\UseCases\CastMember\UpdateCastMemberUseCase;
use Core\Domain\Entity\CastMember as EntityCastMember;
use Core\Domain\Enum\CastMemberType;
use Core\Domain\Repository\CastMemberRepositoryInterface;
use Core\Domain\ValueObject\Uuid as ValueObjectUuid;
use Core\Intermediate\Dtos\CastMember\UpdateCastMemberInputDto;
use Core\Intermediate\Dtos\CastMember\UpdateCastMemberOutputDto;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid as RamseyUuid;

class UpdateCastMemberUseCaseUnitTest extends TestCase
{
    public function test_update()
    {
        $uuid = (string) RamseyUuid::uuid4();

        $mockEntity = \Mockery::mock(EntityCastMember::class, [
            'name',
            CastMemberType::ACTOR,
            new ValueObjectUuid($uuid),
        ]);
        $mockEntity->shouldReceive('id')->andReturn($uuid);
        $mockEntity->shouldReceive('createdAt')->andReturn(date('Y-m-d H:i:s'));
        $mockEntity->shouldReceive('update');

        $mockRepository = \Mockery::mock(\stdClass::class, CastMemberRepositoryInterface::class);
        $mockRepository->shouldReceive('findById')
            ->times(1)
            ->with($uuid)
            ->andReturn($mockEntity);
        $mockRepository->shouldReceive('update')
            ->once()
            ->andReturn($mockEntity);

        $mockInputDto = \Mockery::mock(UpdateCastMemberInputDto::class, [
            $uuid, 'new name',
        ]);

        $useCase = new UpdateCastMemberUseCase($mockRepository);
        $response = $useCase->execute($mockInputDto);

        $this->assertInstanceOf(UpdateCastMemberOutputDto::class, $response);

        \Mockery::close();
    }
}
