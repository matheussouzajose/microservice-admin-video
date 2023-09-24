<?php

namespace Core\Domain\Event;

use Core\Domain\Entity\Video;

class VideoCreatedEvent implements EventInterface
{
    /**
     * @param Video $video
     */
    public function __construct(
        protected Video $video
    ) {
    }

    /**
     * @return string
     */
    public function getEventName(): string
    {
        return 'video.created';
    }

    /**
     * @return array
     */
    public function getPayload(): array
    {
        return [
            'resource_id' => $this->video->id(),
            'file_path' => $this->video->videoFile()->filePath,
        ];
    }
}
