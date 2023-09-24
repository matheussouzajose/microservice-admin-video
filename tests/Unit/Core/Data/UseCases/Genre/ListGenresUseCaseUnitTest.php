<?php

namespace Tests\Unit\Core\Data\UseCases\Genre;

use Core\Data\UseCases\Genre\Paginate\DTO\PaginateGenresInputDto;
use Core\Data\UseCases\Genre\Paginate\DTO\PaginateGenresOutputDto;
use Core\Data\UseCases\Genre\Paginate\PaginateGenresUseCase;
use Core\Domain\Repository\GenreRepositoryInterface;
use Core\Domain\Repository\PaginationInterface;
use Tests\TestCase;
use Tests\Unit\Core\Data\UseCases\UseCaseTrait;

class ListGenresUseCaseUnitTest extends TestCase
{
    use UseCaseTrait;

    public function testListGenres()
    {
        $mockRepository = \Mockery::mock(\stdClass::class, GenreRepositoryInterface::class);
        $mockRepository->shouldReceive('paginate')->once()->andReturn($this->mockPagination());

        $mockDtoInput = \Mockery::mock(PaginateGenresInputDto::class, [
            'teste', 'desc', 1, 15,
        ]);

        $useCase = new PaginateGenresUseCase($mockRepository);
        $response = $useCase->execute($mockDtoInput);

        $this->assertInstanceOf(PaginationInterface::class, $response);

        \Mockery::close();

        /**
         * Spies
         */
        // arrange
        $spy = \Mockery::spy(\stdClass::class, GenreRepositoryInterface::class);
        $spy->shouldReceive('paginate')->andReturn($this->mockPagination());
        $sut = new PaginateGenresUseCase($spy);

        // action
        $sut->execute($mockDtoInput);

        // assert
        $spy->shouldHaveReceived()->paginate(
            'teste', 'desc', 1, 15
        );
    }
}