<?php

namespace Unit\Core\Data\UseCases\Video;

use Core\Data\UseCases\Video\Update\DTO\UpdateVideoInputDto;
use Core\Data\UseCases\Video\Update\DTO\UpdateVideoOutputDto;
use Core\Data\UseCases\Video\Update\UpdateVideoUseCase;
use Core\Domain\ValueObject\Uuid;

class UpdateVideoUseCaseUnitTest extends BaseVideoUseCaseUnitTest
{
    public function test_exec_input_output()
    {
        $this->createUseCase();

        $response = $this->useCase->execute(
            input: $this->createMockInputDTO(),
        );

        $this->assertInstanceOf(UpdateVideoOutputDto::class, $response);
    }

    protected function nameActionRepository(): string
    {
        return 'update';
    }

    protected function getUseCase(): string
    {
        return UpdateVideoUseCase::class;
    }

    protected function createMockInputDTO(
        array $categoriesIds = [],
        array $genresIds = [],
        array $castMembersIds = [],
        array $videoFile = null,
        array $trailerFile = null,
        array $thumbFile = null,
        array $thumbHalf = null,
        array $bannerFile = null,
    ): UpdateVideoInputDto {
        return \Mockery::mock(UpdateVideoInputDto::class, [
            Uuid::random(),
            'title',
            'desc',
            $categoriesIds,
            $genresIds,
            $castMembersIds,
            $videoFile,
            $trailerFile,
            $thumbFile,
            $thumbHalf,
            $bannerFile,
        ]);
    }
}
