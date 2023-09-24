<?php

namespace Core\Data\UseCases\Video\Create;

use Core\Data\UseCases\Video\BaseVideoUseCase;
use Core\Data\UseCases\Video\Create\DTO\CreateVideoInputDto;
use Core\Data\UseCases\Video\Create\DTO\CreateVideoOutputDto;
use Core\Domain\Builder\Video\BuilderVideo;
use Core\Domain\Exception\NotificationException;

class CreateVideoUseCase extends BaseVideoUseCase implements CreateVideoUseCaseInterface
{
    /**
     * @return BuilderVideo
     */
    protected function getBuilder(): BuilderVideo
    {
        return new BuilderVideo;
    }

    /**
     * @param CreateVideoInputDto $input
     * @return CreateVideoOutputDto
     * @throws NotificationException
     * @throws \Throwable
     */
    public function execute(CreateVideoInputDto $input): CreateVideoOutputDto
    {
        $this->validateAllIds($input);

        $this->builder->createEntity($input);

        try {
            $this->repository->insert($this->builder->getEntity());

            $this->storageFiles($input);

            $this->repository->updateMedia($this->builder->getEntity());

            $this->transaction->commit();

            return $this->output();

        } catch (\Throwable $th) {
            $this->transaction->rollback();

            if (isset($pathMedia)) {
                $this->storage->delete($pathMedia);
            }

            throw $th;
        }
    }

    /**
     * @return CreateVideoOutputDto
     */
    private function output(): CreateVideoOutputDto
    {
        $entity = $this->builder->getEntity();

        return new CreateVideoOutputDto(
            id: $entity->id(),
            title: $entity->title,
            description: $entity->description,
            yearLaunched: $entity->yearLaunched,
            duration: $entity->duration,
            opened: $entity->opened,
            rating: $entity->rating,
            createdAt: $entity->createdAt(),
            categories: $entity->categoriesId,
            genres: $entity->genresId,
            castMembers: $entity->castMemberIds,
            videoFile: $entity->videoFile()?->filePath,
            trailerFile: $entity->trailerFile()?->filePath,
            thumbFile: $entity->thumbFile()?->path(),
            thumbHalf: $entity->thumbHalf()?->path(),
            bannerFile: $entity->bannerFile()?->path(),
        );
    }
}
