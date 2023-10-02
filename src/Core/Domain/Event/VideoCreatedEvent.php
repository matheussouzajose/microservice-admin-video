<?php

namespace Core\Domain\Event;

use Core\Domain\Entity\Video;
use Core\Domain\Event\Interfaces\EventInterface;

class VideoCreatedEvent implements EventInterface
{
    public function __construct(
        protected Video $video
    ) {
    }

    public function getEventName(): string
    {
        return 'video.created';
    }

    public function getPayload(): array
    {
        return [
            'resource_id' => $this->video->id(),
            'file_path' => $this->video->videoFile()->filePath,
        ];
    }
}
