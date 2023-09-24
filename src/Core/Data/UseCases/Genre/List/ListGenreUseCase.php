<?php

namespace Core\Data\UseCases\Genre\List;

use Core\Domain\Repository\GenreRepositoryInterface;
use Core\Data\UseCases\Genre\List\DTO\ListGenreInputDto;
use Core\Data\UseCases\Genre\List\DTO\ListGenreOutputDto;

class ListGenreUseCase implements ListGenreUseCaseInterface
{
    /**
     * @param GenreRepositoryInterface $repository
     */
    public function __construct(
        protected GenreRepositoryInterface $repository
    ) {
    }

    /**
     * @param ListGenreInputDto $input
     * @return ListGenreOutputDto
     */
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
