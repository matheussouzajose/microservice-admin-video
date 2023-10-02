<?php

namespace Tests\Unit\Core\Application\UseCases\Genre;

use Core\Application\UseCases\Genre\PaginateGenresUseCase;
use Core\Domain\Repository\GenreRepositoryInterface;
use Core\Domain\Repository\PaginationInterface;
use Core\Intermediate\Dtos\Genre\PaginateGenresInputDto;
use Tests\TestCase;
use Tests\Unit\Core\Application\UseCases\UseCaseTrait;

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
            'teste',
            'desc',
            1,
            15
        );
    }
}
