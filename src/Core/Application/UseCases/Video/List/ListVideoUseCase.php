<?php

namespace Core\Application\UseCases\Video\List;

use Core\Application\UseCases\Video\List\DTO\ListVideoInputDto;
use Core\Application\UseCases\Video\List\DTO\ListVideoOutputDto;
use Core\Domain\Repository\VideoRepositoryInterface;

class ListVideoUseCase implements ListVideoUseCaseInterface
{
    public function __construct(
        private VideoRepositoryInterface $repository,
    ) {
    }

    public function execute(ListVideoInputDto $input): ListVideoOutputDto
    {
        $entity = $this->repository->findById($input->id);

        return new ListVideoOutputDto(
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
