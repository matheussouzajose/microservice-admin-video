<?php

namespace Unit\Core\Application\UseCases\Video;

use Core\Application\UseCases\Interfaces\FileStorageInterface;
use Core\Application\UseCases\Interfaces\TransactionInterface;
use Core\Application\UseCases\Video\Interfaces\VideoEventManagerInterface;
use Core\Domain\Entity\Video;
use Core\Domain\Enum\Rating;
use Core\Domain\Exception\NotFoundException;
use Core\Domain\Repository\CastMemberRepositoryInterface;
use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\Domain\Repository\GenreRepositoryInterface;
use Core\Domain\Repository\VideoRepositoryInterface;
use Tests\TestCase;

abstract class BaseVideoUseCaseUnitTest extends TestCase
{
    protected $useCase;

    abstract protected function nameActionRepository(): string;

    abstract protected function getUseCase(): string;

    abstract protected function createMockInputDTO(
        array $categoriesIds = [],
        array $genresIds = [],
        array $castMembersIds = [],
        array $videoFile = null,
        array $trailerFile = null,
        array $thumbFile = null,
        array $thumbHalf = null,
        array $bannerFile = null,
    );

    protected function createUseCase(
        int $timesCallMethodActionRepository = 1,
        int $timesCallMethodUpdateMediaRepository = 1,
        int $timesCallMethodCommitTransaction = 1,
        int $timesCallMethodRollbackTransaction = 0,
        int $timesCallMethodStoreFileStorage = 0,
        int $timesCallMethodDispatchEventManager = 0
    ): void {
        $this->useCase = new ($this->getUseCase())(
            repository: $this->createMockRepository(
                timesCallAction: $timesCallMethodActionRepository,
                timesCallUpdateMedia: $timesCallMethodUpdateMediaRepository,
            ),
            transaction: $this->createMockTransaction(
                timesCallCommit: $timesCallMethodCommitTransaction,
                timesCallRollback: $timesCallMethodRollbackTransaction,
            ),
            storage: $this->createMockFileStorage(
                timesCall: $timesCallMethodStoreFileStorage,
            ),
            eventManager: $this->createMockEventManager(
                times: $timesCallMethodDispatchEventManager
            ),
            categoryRepository: $this->createMockRepositoryCategory(),
            genreRepository: $this->createMockRepositoryGenre(),
            castMemberRepository: $this->createMockRepositoryCastMember(),
        );
    }

    /**
     * @dataProvider dataProviderIds
     */
    public function test_exception_categories_ids(
        string $label,
        array $ids,
    ) {
        $this->createUseCase(
            timesCallMethodActionRepository: 0,
            timesCallMethodUpdateMediaRepository: 0,
            timesCallMethodCommitTransaction: 0
        );

        $this->expectException(NotFoundException::class);
        $this->expectExceptionMessage(sprintf(
            '%s %s not found',
            $label,
            implode(', ', $ids)
        ));

        $this->useCase->execute(
            input: $this->createMockInputDTO(
                categoriesIds: $ids
            ),
        );
    }

    public function dataProviderIds(): array
    {
        return [
            ['Category', ['uuid-1']],
            ['Categories', ['uuid-1', 'uuid-2']],
            ['Categories', ['uuid-1', 'uuid-2', 'uuid-3', 'uuid-4']],
        ];
    }

    /**
     * @dataProvider dataProviderFiles
     */
    public function test_upload_files(
        array $video,
        array $trailer,
        array $thumb,
        array $thumbHalf,
        array $banner,
        int $storage,
        int $event = 0,
    ) {

        $this->createUseCase(
            timesCallMethodStoreFileStorage: $storage,
            timesCallMethodDispatchEventManager: $event
        );

        $response = $this->useCase->execute(
            input: $this->createMockInputDTO(
                videoFile: $video['value'],
                trailerFile: $trailer['value'],
                thumbFile: $thumb['value'],
                thumbHalf: $thumbHalf['value'],
                bannerFile: $banner['value'],
            ),
        );

        $this->assertEquals($response->videoFile, $video['expected']);
        $this->assertEquals($response->trailerFile, $trailer['expected']);
        $this->assertEquals($response->thumbFile, $thumb['expected']);
        $this->assertEquals($response->thumbHalf, $thumbHalf['expected']);
        $this->assertEquals($response->bannerFile, $banner['expected']);
    }

    public function dataProviderFiles(): array
    {
        return [
            [
                'video' => ['value' => ['tmp' => 'tmp/file.mp4'], 'expected' => 'path/file.png'],
                'trailer' => ['value' => ['tmp' => 'tmp/file.mp4'], 'expected' => 'path/file.png'],
                'thumb' => ['value' => ['tmp' => 'tmp/file.mp4'], 'expected' => 'path/file.png'],
                'thumbHalf' => ['value' => ['tmp' => 'tmp/file.mp4'], 'expected' => 'path/file.png'],
                'banner' => ['value' => ['tmp' => 'tmp/file.mp4'], 'expected' => 'path/file.png'],
                'timesStorage' => 5,
                'dispatch' => 1,
            ], [
                'video' => ['value' => ['tmp' => 'tmp/file.mp4'], 'expected' => 'path/file.png'],
                'trailer' => ['value' => null, 'expected' => null],
                'thumb' => ['value' => ['tmp' => 'tmp/file.mp4'], 'expected' => 'path/file.png'],
                'thumbHalf' => ['value' => null, 'expected' => null],
                'banner' => ['value' => ['tmp' => 'tmp/file.mp4'], 'expected' => 'path/file.png'],
                'timesStorage' => 3,
                'dispatch' => 1,
            ], [
                'video' => ['value' => null, 'expected' => null],
                'trailer' => ['value' => null, 'expected' => null],
                'thumb' => ['value' => ['tmp' => 'tmp/file.mp4'], 'expected' => 'path/file.png'],
                'thumbHalf' => ['value' => null, 'expected' => null],
                'banner' => ['value' => ['tmp' => 'tmp/file.mp4'], 'expected' => 'path/file.png'],
                'timesStorage' => 2,
            ], [
                'video' => ['value' => null, 'expected' => null],
                'trailer' => ['value' => null, 'expected' => null],
                'thumb' => ['value' => null, 'expected' => null],
                'thumbHalf' => ['value' => null, 'expected' => null],
                'banner' => ['value' => null, 'expected' => null],
                'timesStorage' => 0,
            ],
        ];
    }

    private function createMockRepository(
        int $timesCallAction,
        int $timesCallUpdateMedia,
    ): VideoRepositoryInterface {
        $entity = $this->createEntity();
        $mockRepository = \Mockery::mock(\stdClass::class, VideoRepositoryInterface::class);

        $mockRepository->shouldReceive($this->nameActionRepository())
            ->times($timesCallAction)
            ->andReturn($entity);
        $mockRepository->shouldReceive('findById')
            ->andReturn($entity);
        $mockRepository->shouldReceive('updateMedia')
            ->times($timesCallUpdateMedia);

        return $mockRepository;
    }

    private function createMockRepositoryCategory(array $categoriesRenponse = []): CategoryRepositoryInterface
    {
        $mockRepository = \Mockery::mock(\stdClass::class, CategoryRepositoryInterface::class);

        $mockRepository->shouldReceive('getIdsByEntitiesIds')->andReturn($categoriesRenponse);

        return $mockRepository;
    }

    private function createMockRepositoryGenre(array $genresResponseIds = []): GenreRepositoryInterface
    {
        $mockRepository = \Mockery::mock(\stdClass::class, GenreRepositoryInterface::class);

        $mockRepository->shouldReceive('getIdsByEntitiesIds')->andReturn($genresResponseIds);

        return $mockRepository;
    }

    private function createMockRepositoryCastMember(array $castMemberResponseIds = []): CastMemberRepositoryInterface
    {
        $mockRepository = \Mockery::mock(\stdClass::class, CastMemberRepositoryInterface::class);

        $mockRepository->shouldReceive('getIdsByEntitiesIds')->andReturn($castMemberResponseIds);

        return $mockRepository;
    }

    private function createMockTransaction(
        int $timesCallCommit,
        int $timesCallRollback
    ): TransactionInterface {
        $mockTransaction = \Mockery::mock(\stdClass::class, TransactionInterface::class);

        $mockTransaction->shouldReceive('commit')->times($timesCallCommit);
        $mockTransaction->shouldReceive('rollback')->times($timesCallRollback);

        return $mockTransaction;
    }

    private function createMockFileStorage(int $timesCall): FileStorageInterface
    {
        $mockFileStorage = \Mockery::mock(\stdClass::class, FileStorageInterface::class);

        $mockFileStorage->shouldReceive('store')
            ->times($timesCall)
            ->andReturn('path/file.png');

        return $mockFileStorage;
    }

    private function createMockEventManager(int $times): VideoEventManagerInterface
    {
        $mockEventManager = \Mockery::mock(\stdClass::class, VideoEventManagerInterface::class);
        $mockEventManager->shouldReceive('dispatch')->times($times);

        return $mockEventManager;
    }

    private function createEntity(): Video
    {
        return new Video(
            title: 'title',
            description: 'desc',
            yearLaunched: 2026,
            duration: 1,
            opened: true,
            rating: Rating::L,
        );
    }

    protected function tearDown(): void
    {
        \Mockery::close();

        parent::tearDown();
    }
}
