<?php

namespace Unit\Core\Application\UseCases\Video;

use Core\Application\UseCases\Video\PaginateVideosUseCase;
use Core\Domain\Repository\PaginationInterface;
use Core\Domain\Repository\VideoRepositoryInterface;
use Core\Intermediate\Dtos\Video\PaginateVideosInputDto;
use Tests\TestCase;
use Tests\Unit\Core\Application\UseCases\UseCaseTrait;

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
