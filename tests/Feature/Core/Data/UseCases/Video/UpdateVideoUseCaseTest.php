<?php

namespace Feature\Core\Data\UseCases\Video;


use App\Models\Video;
use Core\Data\UseCases\Video\Update\DTO\UpdateVideoInputDto;
use Core\Data\UseCases\Video\Update\UpdateVideoUseCase;

class UpdateVideoUseCaseTest extends BaseVideoUseCaseTest
{
    public function useCase(): string
    {
        return UpdateVideoUseCase::class;
    }

    public function inputDTO(
        array $categories = [],
        array $genres = [],
        array $castMembers = [],
        ?array $videoFile = null,
        ?array $trailerFile = null,
        ?array $bannerFile = null,
        ?array $thumbFile = null,
        ?array $thumbHalf = null,
    ): object {
        $video = Video::factory()->create();

        return new UpdateVideoInputDto(
            id: $video->id,
            title: 'test',
            description: 'test',
            categories: $categories,
            genres: $genres,
            castMembers: $castMembers,
            videoFile: $videoFile,
            trailerFile: $trailerFile,
            thumbFile: $thumbFile,
            thumbHalf: $thumbHalf,
            bannerFile: $bannerFile,
        );
    }
}

