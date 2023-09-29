<?php

namespace Core\Application\UseCases\Genre\List;

use Core\Application\UseCases\Genre\List\DTO\ListGenreInputDto;
use Core\Application\UseCases\Genre\List\DTO\ListGenreOutputDto;
use Core\Domain\Repository\GenreRepositoryInterface;

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
