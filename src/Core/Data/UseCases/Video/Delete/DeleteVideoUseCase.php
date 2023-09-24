<?php

namespace Core\Data\UseCases\Video\Delete;

use Core\Data\UseCases\Video\Delete\DTO\DeleteVideoInputDto;
use Core\Data\UseCases\Video\Delete\DTO\DeleteVideoOutputDto;
use Core\Domain\Repository\VideoRepositoryInterface;

class DeleteVideoUseCase implements DeleteVideoUseCaseInterface
{
    /**
     * @param VideoRepositoryInterface $repository
     */
    public function __construct(
        private VideoRepositoryInterface $repository,
    ) {
    }

    /**
     * @param DeleteVideoInputDto $input
     * @return DeleteVideoOutputDto
     */
    public function execute(DeleteVideoInputDto $input): DeleteVideoOutputDto
    {
        $deleted = $this->repository->delete($input->id);

        return new DeleteVideoOutputDto(
            deleted: $deleted
        );
    }
}
