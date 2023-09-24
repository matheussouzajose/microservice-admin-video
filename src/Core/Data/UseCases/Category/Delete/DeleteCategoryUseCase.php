<?php

namespace Core\Data\UseCases\Category\Delete;

use Core\Data\UseCases\Category\Delete\DTO\DeleteCategoryInputDto;
use Core\Data\UseCases\Category\Delete\DTO\DeleteCategoryOutputDto;
use Core\Domain\Repository\CategoryRepositoryInterface;

class DeleteCategoryUseCase implements DeleteCategoryUseCaseInterface
{
    /**
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository
    ) {
    }

    /**
     * @param DeleteCategoryInputDto $input
     * @return DeleteCategoryOutputDto
     */
    public function execute(DeleteCategoryInputDto $input): DeleteCategoryOutputDto
    {
        $responseDelete = $this->categoryRepository->delete($input->id);

        return new DeleteCategoryOutputDto(
            success: $responseDelete
        );
    }
}
