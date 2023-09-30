<?php

namespace Core\Application\UseCases\Genre;

use Core\Domain\Repository\GenreRepositoryInterface;
use Core\Domain\UseCases\Genre\DeleteGenreUseCaseInterface;
use Core\Intermediate\Dtos\Genre\DeleteGenreOutputDto;
use Core\Intermediate\Dtos\Genre\ListGenreInputDto;

class DeleteGenreUseCase implements DeleteGenreUseCaseInterface
{
    public function __construct(
        protected GenreRepositoryInterface $repository
    ) {
    }

    public function execute(ListGenreInputDto $input): DeleteGenreOutputDto
    {
        $success = $this->repository->delete($input->id);

        return new DeleteGenreOutputDto(
            success: $success
        );
    }
}
