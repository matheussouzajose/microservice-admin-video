<?php

namespace Core\Application\UseCases\Genre\Update;

use Core\Application\UseCases\Genre\BaseGenreUseCase;
use Core\Application\UseCases\Genre\Update\DTO\UpdateGenreInputDto;
use Core\Application\UseCases\Genre\Update\DTO\UpdateGenreOutputDto;
use Core\Domain\Builder\Genre\GenreBuilderInterface;
use Core\Domain\Builder\Genre\UpdateGenreBuilder;
use Core\Domain\Exception\EntityValidationException;

class UpdateGenreUseCase extends BaseGenreUseCase implements UpdateGenreUseCaseInterface
{
    /**
     * @throws EntityValidationException
     * @throws \Throwable
     */
    public function execute(UpdateGenreInputDto $input): UpdateGenreOutputDto
    {
        try {
            $entity = $this->repository->findById($input->id);
            $entity->update(
                name: $input->name,
            );

            $this->builder->setEntity($entity);
            $this->builder->addCategories($input->categoriesId);

            $this->validateAllIds($input);

            $genreDb = $this->repository->update($this->builder->getEntity());

            $this->transaction->commit();

            return new UpdateGenreOutputDto(
                id: (string) $genreDb->id,
                name: $genreDb->name,
                is_active: $genreDb->isActive,
                created_at: $genreDb->createdAt(),
            );
        } catch (\Throwable $th) {
            $this->transaction->rollback();
            throw $th;
        }
    }

    protected function getBuilder(): GenreBuilderInterface
    {
        return new UpdateGenreBuilder();
    }
}
