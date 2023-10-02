<?php

namespace Core\Application\UseCases\Video;

use Core\Domain\Enum\MediaStatus;
use Core\Domain\Exception\NotFoundException;
use Core\Domain\Exception\NotificationException;
use Core\Domain\Repository\VideoRepositoryInterface;
use Core\Domain\UseCases\Video\ChangeEncodedPathVideoUseCaseInterface;
use Core\Domain\ValueObject\Media;
use Core\Intermediate\Dtos\Video\ChangeEncodedVideoInputDto;
use Core\Intermediate\Dtos\Video\ChangeEncodedVideoOutputDto;

class ChangeEncodedPathVideoUseCase implements ChangeEncodedPathVideoUseCaseInterface
{
    public function __construct(
        protected VideoRepositoryInterface $repository
    ) {
    }

    /**
     * @throws NotFoundException
     * @throws NotificationException
     */
    public function execute(ChangeEncodedVideoInputDto $input): ChangeEncodedVideoOutputDto
    {
        $entity = $this->repository->findById($input->id);

        $entity->setVideoFile(
            new Media(
                filePath: $entity->videoFile()?->filePath ?? '',
                mediaStatus: MediaStatus::COMPLETE,
                encodedPath: $input->encodedPath
            )
        );

        $this->repository->updateMedia($entity);

        return new ChangeEncodedVideoOutputDTO(
            id: $entity->id(),
            encodedPath: $input->encodedPath
        );
    }
}
