<?php

namespace Unit\Core\Data\UseCases\Video;

use Core\Data\UseCases\Video\Paginate\DTO\PaginateVideosInputDto;
use Core\Data\UseCases\Video\Paginate\PaginateVideosUseCase;
use Core\Domain\Repository\PaginationInterface;
use Core\Domain\Repository\VideoRepositoryInterface;
use Tests\TestCase;
use Tests\Unit\Core\Data\UseCases\UseCaseTrait;

class ListVideosUseCaseUnitTest extends TestCase
{
    use UseCaseTrait;

    public function test_list_paginate()
    {
        $useCase = new PaginateVideosUseCase(
            repository: $this->mockRepository()
        );

        $response = $useCase->execute(
            input: $this->mockInputDTO()
        );

        $this->assertInstanceOf(PaginationInterface::class, $response);

        \Mockery::close();
    }

    private function mockRepository()
    {
        $mockRepository = \Mockery::mock(\stdClass::class, VideoRepositoryInterface::class);
        $mockRepository->shouldReceive('paginate')
            ->once()
            ->andReturn($this->mockPagination());

        return $mockRepository;
    }

    private function mockInputDTO()
    {
        return \Mockery::mock(PaginateVideosInputDto::class, [
            '',
            'DESC',
            1,
            15,
        ]);
    }
}
