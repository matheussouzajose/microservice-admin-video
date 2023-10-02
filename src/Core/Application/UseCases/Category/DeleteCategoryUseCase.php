<?php

namespace Core\Application\UseCases\Category;

use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\Domain\UseCases\Category\DeleteCategoryUseCaseInterface;
use Core\Intermediate\Dtos\Category\DeleteCategoryInputDto;
use Core\Intermediate\Dtos\Category\DeleteCategoryOutputDto;

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
