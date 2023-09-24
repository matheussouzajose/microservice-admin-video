<?php

namespace Tests\Unit\Core\Data\UseCases\CastMember;

use Core\Data\UseCases\CastMember\Create\CreateCastMemberUseCase;
use Core\Data\UseCases\CastMember\Create\DTO\CreateCastMemberInputDto;
use Core\Data\UseCases\CastMember\Create\DTO\CreateCastMemberOutputDto;
use Core\Domain\Entity\CastMember as EntityCastMember;
use Core\Domain\Enum\CastMemberType;
use Core\Domain\Repository\CastMemberRepositoryInterface;
use PHPUnit\Framework\TestCase;

class CreateCastMemberUseCaseUnitTest extends TestCase
{
    public function test_create()
    {
        $mockEntity = \Mockery::mock(EntityCastMember::class, ['name', CastMemberType::ACTOR]);
        $mockEntity->shouldReceive('id');
        $mockEntity->shouldReceive('createdAt')->andReturn(date('Y-m-d H:i:s'));

        $mockRepository = \Mockery::mock(\stdClass::class, CastMemberRepositoryInterface::class);
        $mockRepository->shouldReceive('insert')
            ->once()
            ->andReturn($mockEntity);
        $useCase = new CreateCastMemberUseCase($mockRepository);

        $mockDto = \Mockery::mock(CreateCastMemberInputDto::class, [
            'name', 1,
        ]);

        $response = $useCase->execute($mockDto);

        $this->assertInstanceOf(CreateCastMemberOutputDto::class, $response);
        $this->assertNotEmpty($response->id);
        $this->assertEquals('name', $response->name);
        $this->assertEquals(1, $response->type);
        $this->assertNotEmpty($response->created_at);

        \Mockery::close();
    }
}
