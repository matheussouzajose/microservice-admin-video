<?php

namespace Tests\Unit\Core\Application\UseCases\CastMember;

use Core\Application\UseCases\CastMember\Delete\DeleteCastMemberUseCase;
use Core\Application\UseCases\CastMember\Delete\DTO\DeleteCastMemberInputDto;
use Core\Application\UseCases\CastMember\Delete\DTO\DeleteCastMemberOutputDto;
use Core\Domain\Repository\CastMemberRepositoryInterface;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid as RamseyUuid;

class DeleteCastMemberUseCaseUnitTest extends TestCase
{
    public function test_delete()
    {
        $uuid = (string) RamseyUuid::uuid4();

        $mockRepository = \Mockery::mock(\stdClass::class, CastMemberRepositoryInterface::class);
        $mockRepository->shouldReceive('delete')
            ->once()
            ->andReturn(true);

        $mockInputDto = \Mockery::mock(DeleteCastMemberInputDto::class, [$uuid]);

        $useCase = new DeleteCastMemberUseCase($mockRepository);
        $response = $useCase->execute($mockInputDto);

        $this->assertInstanceOf(DeleteCastMemberOutputDto::class, $response);

        \Mockery::close();
    }
}
