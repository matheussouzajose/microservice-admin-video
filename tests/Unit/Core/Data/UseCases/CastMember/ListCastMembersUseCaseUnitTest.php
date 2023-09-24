<?php

namespace Tests\Unit\Core\Data\UseCases\CastMember;

use Core\Data\UseCases\CastMember\Paginate\DTO\PaginateCastMembersInputDto;
use Core\Data\UseCases\CastMember\Paginate\DTO\PaginateCastMembersOutputDto;
use Core\Data\UseCases\CastMember\Paginate\PaginateCastMembersUseCase;
use Core\Domain\Repository\CastMemberRepositoryInterface;
use Core\Domain\Repository\PaginationInterface;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Core\Data\UseCases\UseCaseTrait;

class ListCastMembersUseCaseUnitTest extends TestCase
{
    use UseCaseTrait;

    public function test_list()
    {
        $mockRepository = \Mockery::mock(\stdClass::class, CastMemberRepositoryInterface::class);
        $mockRepository->shouldReceive('paginate')
            ->once()
            ->andReturn($this->mockPagination());

        $useCase = new PaginateCastMembersUseCase($mockRepository);

        $mockInputDto = \Mockery::mock(PaginateCastMembersInputDto::class, [
            'filter', 'desc', 1, 15,
        ]);

        $response = $useCase->execute($mockInputDto);

        $this->assertInstanceOf(PaginationInterface::class, $response);

        \Mockery::close();
    }
}
