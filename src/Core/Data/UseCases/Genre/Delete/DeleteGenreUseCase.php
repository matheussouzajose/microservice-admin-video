<?php

namespace Core\Data\UseCases\Genre\Delete;

use Core\Data\UseCases\Genre\Delete\DTO\DeleteGenreOutputDto;
use Core\Domain\Repository\GenreRepositoryInterface;
use Core\Data\UseCases\Genre\List\DTO\ListGenreInputDto;

class DeleteGenreUseCase implements DeleteGenreUseCaseInterface
{
    /**
     * @param GenreRepositoryInterface $repository
     */
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
