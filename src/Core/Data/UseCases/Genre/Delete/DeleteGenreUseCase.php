<?php

namespace Core\Data\UseCases\Genre\Delete;

use Core\Data\UseCases\Genre\Delete\DTO\DeleteGenreOutputDto;
use Core\Data\UseCases\Genre\List\DTO\ListGenreInputDto;
use Core\Domain\Repository\GenreRepositoryInterface;

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
