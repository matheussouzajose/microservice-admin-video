<?php

namespace Core\Application\UseCases\Category;

use Core\Domain\Exception\EntityValidationException;
use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\Domain\UseCases\Category\UpdateCategoryUseCaseInterface;
use Core\Intermediate\Dtos\Category\UpdateCategoryInputDto;
use Core\Intermediate\Dtos\Category\UpdateCategoryOutputDto;

class UpdateCategoryUseCase implements UpdateCategoryUseCaseInterface
{
    public function __construct(
        protected CategoryRepositoryInterface $categoryRepository
    ) {
    }

    /**
     * @throws EntityValidationException
     */
    public function execute(UpdateCategoryInputDto $input): UpdateCategoryOutputDto
    {
        $entity = $this->categoryRepository->findById($input->id);
        $entity->update(
            name: $input->name,
            description: $input->description ?? $entity->description,
        );

        $categoryUpdated = $this->categoryRepository->update($entity);

        return new UpdateCategoryOutputDto(
            id: $categoryUpdated->id,
            name: $categoryUpdated->name,
            description: $categoryUpdated->description,
            is_active: $categoryUpdated->isActive,
            created_at: $categoryUpdated->createdAt()
        );
    }
}
