<?php

namespace Core\Data\UseCases\Video\Update\DTO;

class UpdateVideoInputDto
{
    /**
     * @param string $id
     * @param string $title
     * @param string $description
     * @param array $categories
     * @param array $genres
     * @param array $castMembers
     * @param array|null $videoFile
     * @param array|null $trailerFile
     * @param array|null $thumbFile
     * @param array|null $thumbHalf
     * @param array|null $bannerFile
     */
    public function __construct(
        public string $id,
        public string $title,
        public string $description,
        public array $categories,
        public array $genres,
        public array $castMembers,
        public ?array $videoFile = null,
        public ?array $trailerFile = null,
        public ?array $thumbFile = null,
        public ?array $thumbHalf = null,
        public ?array $bannerFile = null,
    ) {
    }
}
