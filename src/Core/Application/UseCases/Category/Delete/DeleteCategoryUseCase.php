<?php

namespace Core\Application\UseCases\Category\Delete;

use Core\Application\UseCases\Category\Delete\DTO\DeleteCategoryInputDto;
use Core\Application\UseCases\Category\Delete\DTO\DeleteCategoryOutputDto;
use Core\Domain\Repository\CategoryRepositoryInterface;

class DeleteCategoryUseCase implements DeleteCategoryUseCaseInterface
{
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository
    ) {
    }

    public function execute(DeleteCategoryInputDto $input): DeleteCategoryOutputDto
    {
        $responseDelete = $this->categoryRepository->delete($input->id);

        return new DeleteCategoryOutputDto(
            success: $responseDelete
        );
    }
}
