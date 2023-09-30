<?php

namespace Core\Application\UseCases\Genre;

use Core\Domain\Repository\GenreRepositoryInterface;
use Core\Domain\UseCases\Genre\ListGenreUseCaseInterface;
use Core\Intermediate\Dtos\Genre\ListGenreInputDto;
use Core\Intermediate\Dtos\Genre\ListGenreOutputDto;

class ListGenreUseCase implements ListGenreUseCaseInterface
{
    public function __construct(
        protected GenreRepositoryInterface $repository
    ) {
    }

    public function execute(ListGenreInputDto $input): ListGenreOutputDto
    {
        $genre = $this->repository->findById(entityId: $input->id);

        return new ListGenreOutputDto(
            id: (string) $genre->id,
            name: $genre->name,
            is_active: $genre->isActive,
            created_at: $genre->createdAt(),
        );
    }
}
