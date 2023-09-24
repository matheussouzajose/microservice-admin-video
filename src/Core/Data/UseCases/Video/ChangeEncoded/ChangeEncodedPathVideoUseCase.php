<?php

namespace Core\Data\UseCases\Video\ChangeEncoded;

use Core\Data\UseCases\Video\ChangeEncoded\DTO\ChangeEncodedVideoInputDto;
use Core\Data\UseCases\Video\ChangeEncoded\DTO\ChangeEncodedVideoOutputDto;
use Core\Domain\Enum\MediaStatus;
use Core\Domain\Exception\NotFoundException;
use Core\Domain\Exception\NotificationException;
use Core\Domain\Repository\VideoRepositoryInterface;
use Core\Domain\ValueObject\Media;

class ChangeEncodedPathVideoUseCase implements ChangeEncodedPathVideoUseCaseInterface
{
    /**
     * @param VideoRepositoryInterface $repository
     */
    public function __construct(
        protected VideoRepositoryInterface $repository
    ) {
    }

    /**
     * @param ChangeEncodedVideoInputDto $input
     * @return ChangeEncodedVideoOutputDto
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
