<?php

namespace Core\Application\UseCases\Video;

use Core\Domain\Repository\VideoRepositoryInterface;
use Core\Domain\UseCases\Video\DeleteVideoUseCaseInterface;
use Core\Intermediate\Dtos\Video\DeleteVideoInputDto;
use Core\Intermediate\Dtos\Video\DeleteVideoOutputDto;

class DeleteVideoUseCase implements DeleteVideoUseCaseInterface
{
    public function __construct(
        private VideoRepositoryInterface $repository,
    ) {
    }

    public function execute(DeleteVideoInputDto $input): DeleteVideoOutputDto
    {
        $deleted = $this->repository->delete($input->id);

        return new DeleteVideoOutputDto(
            deleted: $deleted
        );
    }
}
