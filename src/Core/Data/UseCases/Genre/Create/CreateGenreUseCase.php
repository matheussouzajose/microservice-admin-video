<?php

namespace Core\Data\UseCases\Genre\Create;

use Core\Data\UseCases\Genre\BaseGenreUseCase;
use Core\Data\UseCases\Genre\Create\DTO\CreateGenreInputDto;
use Core\Data\UseCases\Genre\Create\DTO\CreateGenreOutputDto;
use Core\Domain\Builder\Genre\GenreBuilder;
use Core\Domain\Builder\Genre\GenreBuilderInterface;
use Core\Domain\Exception\EntityValidationException;
use Core\Domain\Exception\NotFoundException;

class CreateGenreUseCase extends BaseGenreUseCase implements CreateGenreUseCaseInterface
{
    /**
     * @throws NotFoundException
     * @throws EntityValidationException
     * @throws \Throwable
     */
    public function execute(CreateGenreInputDto $input): CreateGenreOutputDto
    {
        try {
            $this->builder->createEntity($input);

            $this->validateAllIds($input);

            $genreDb = $this->repository->insert($this->builder->getEntity());

            $this->transaction->commit();

            return new CreateGenreOutputDto(
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
        return new GenreBuilder();
    }
}
