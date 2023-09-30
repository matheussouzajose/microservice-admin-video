<?php

namespace Tests\Unit\Core\Application\UseCases\CastMember;

use Core\Application\UseCases\CastMember\CreateCastMemberUseCase;
use Core\Domain\Entity\CastMember as EntityCastMember;
use Core\Domain\Enum\CastMemberType;
use Core\Domain\Repository\CastMemberRepositoryInterface;
use Core\Intermediate\Dtos\CastMember\CreateCastMemberInputDto;
use Core\Intermediate\Dtos\CastMember\CreateCastMemberOutputDto;
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
