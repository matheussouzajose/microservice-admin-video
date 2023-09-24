<?php

namespace Feature\App\Repositories\Eloquent;

use App\Enums\ImageTypes;
use App\Models\CastMember;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Video as Model;
use App\Repositories\Eloquent\VideoEloquentRepository;
use Core\Domain\Entity\Video;
use Core\Domain\Enum\MediaStatus;
use Core\Domain\Enum\Rating;
use Core\Domain\Exception\NotFoundException;
use Core\Domain\Repository\VideoRepositoryInterface;
use Core\Domain\ValueObject\Image;
use Core\Domain\ValueObject\Media;
use Core\Domain\ValueObject\Uuid;
use Tests\TestCase;

class VideoEloquentRepositoryTest extends TestCase
{
    protected VideoRepositoryInterface $repository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = new VideoEloquentRepository(
            new Model()
        );
    }

    public function testImplementsInterface()
    {
        $this->assertInstanceOf(
            VideoRepositoryInterface::class,
            $this->repository
        );
    }

    public function testInsert()
    {
        $entity = new Video(
            title: 'Test',
            description: 'Test',
            yearLaunched: 2026,
            duration: 1,
            opened: true,
            rating: Rating::L,
        );

        $this->repository->insert($entity);

        $this->assertDatabaseHas('videos', [
            'id' => $entity->id(),
        ]);
    }

    public function testInsertWithRelationships()
    {
        $categories = Category::factory()->count(4)->create();
        $genres = Genre::factory()->count(4)->create();
        $castMembers = CastMember::factory()->count(4)->create();

        $entity = new Video(
            title: 'Test',
            description: 'Test',
            yearLaunched: 2026,
            duration: 1,
            opened: true,
            rating: Rating::L,
        );

        foreach ($categories as $category) {
            $entity->addCategoryId($category->id);
        }
        foreach ($genres as $genre) {
            $entity->addGenre($genre->id);
        }
        foreach ($castMembers as $castMember) {
            $entity->addCastMember($castMember->id);
        }

        $entityInDb = $this->repository->insert($entity);
        $this->assertDatabaseHas('videos', [
            'id' => $entity->id(),
        ]);

        $this->assertDatabaseCount('category_video', 4);
        $this->assertDatabaseCount('genre_video', 4);
        $this->assertDatabaseCount('cast_member_video', 4);

        $this->assertEqualsCanonicalizing($categories->pluck('id')->toArray(), $entityInDb->categoriesId);
        $this->assertEqualsCanonicalizing($genres->pluck('id')->toArray(), $entityInDb->genresId);
        $this->assertEqualsCanonicalizing($castMembers->pluck('id')->toArray(), $entityInDb->castMemberIds);
    }

    public function testNotFoundVideo()
    {
        $this->expectException(NotFoundException::class);

        $this->repository->findById('fake_value');
    }

    public function testFinById()
    {
        $video = Model::factory()->create();

        $response = $this->repository->findById($video->id);

        $this->assertEquals($video->id, $response->id());
        $this->assertEquals($video->title, $response->title);
    }

    public function testFindAll()
    {
        Model::factory()->count(10)->create();

        $response = $this->repository->findAll();

        $this->assertCount(10, $response);
    }

    public function testFindAllWithFilter()
    {
        Model::factory()->count(10)->create();
        Model::factory()->count(10)->create([
            'title' => 'Test',
        ]);

        $response = $this->repository->findAll(
            filter: 'Test'
        );

        $this->assertCount(10, $response);
        $this->assertDatabaseCount('videos', 20);
    }

    /**
     * @dataProvider dataProviderPagination
     */
    public function testPagination(
        int $page,
        int $totalPage,
        int $total = 50,
    ) {
        Model::factory()->count($total)->create();

        $response = $this->repository->paginate(
            page: $page,
            totalPage: $totalPage
        );

        $this->assertCount($totalPage, $response->items());
        $this->assertEquals($total, $response->total());
        $this->assertEquals($page, $response->currentPage());
        $this->assertEquals($totalPage, $response->perPage());
    }

    public function dataProviderPagination(): array
    {
        return [
            [
                'page' => 1,
                'totalPage' => 10,
                'total' => 100,
            ], [
                'page' => 2,
                'totalPage' => 15,
            ], [
                'page' => 3,
                'totalPage' => 15,
            ],
        ];
    }

    public function testUpdateNotFoundId()
    {
        $this->expectException(NotFoundException::class);

        $entity = new Video(
            title: 'Test',
            description: 'Test',
            yearLaunched: 2026,
            duration: 1,
            opened: true,
            rating: Rating::L,
        );

        $this->repository->update($entity);
    }

    public function testUpdate()
    {
        $categories = Category::factory()->count(10)->create();
        $genres = Genre::factory()->count(10)->create();
        $castMembers = CastMember::factory()->count(10)->create();

        $videoDb = Model::factory()->create();

        $this->assertDatabaseHas('videos', [
            'title' => $videoDb->title,
        ]);

        $entity = new Video(
            title: 'Test',
            description: 'Test',
            yearLaunched: 2026,
            duration: 1,
            opened: true,
            rating: Rating::L,
            id: new Uuid($videoDb->id),
            createdAt: new \DateTime($videoDb->created_at),
        );

        foreach ($categories as $category) {
            $entity->addCategoryId($category->id);
        }
        foreach ($genres as $genre) {
            $entity->addGenre($genre->id);
        }
        foreach ($castMembers as $castMember) {
            $entity->addCastMember($castMember->id);
        }

        $entityInDb = $this->repository->update($entity);

        $this->assertDatabaseHas('videos', [
            'title' => 'Test',
        ]);

        $this->assertDatabaseCount('category_video', 10);
        $this->assertDatabaseCount('genre_video', 10);
        $this->assertDatabaseCount('cast_member_video', 10);

        $this->assertEqualsCanonicalizing($categories->pluck('id')->toArray(), $entityInDb->categoriesId);
        $this->assertEqualsCanonicalizing($genres->pluck('id')->toArray(), $entityInDb->genresId);
        $this->assertEqualsCanonicalizing($castMembers->pluck('id')->toArray(), $entityInDb->castMemberIds);
    }

    public function testDeleteNotFound()
    {
        $this->expectException(NotFoundException::class);

        $this->repository->delete('fake_value');
    }

    public function testDelete()
    {
        $video = Model::factory()->create();

        $this->assertDatabaseHas('videos', [
            'id' => $video->id,
        ]);

        $this->repository->delete($video->id);

        $this->assertSoftDeleted('videos', [
            'id' => $video->id,
        ]);
    }

    public function testInsertWithMediaTrailer()
    {
        $entity = new Video(
            title: 'Test',
            description: 'Test',
            yearLaunched: 2026,
            duration: 1,
            opened: true,
            rating: Rating::L,
            trailerFile: new Media(
                filePath: 'test.mp4',
                mediaStatus: MediaStatus::PROCESSING,
            ),
        );
        $this->repository->insert($entity);

        $this->assertDatabaseCount('medias_video', 0);
        $this->repository->updateMedia($entity);
        $this->assertDatabaseHas('medias_video', [
            'video_id' => $entity->id(),
            'file_path' => 'test.mp4',
            'media_status' => (string) MediaStatus::PROCESSING->value,
        ]);

        $entity->setTrailerFile(new Media(
            filePath: 'test2.mp4',
            mediaStatus: MediaStatus::COMPLETE,
            encodedPath: 'test2.xpto',
        ));

        $entityDb = $this->repository->updateMedia($entity);
        $this->assertDatabaseCount('medias_video', 1);
        $this->assertDatabaseHas('medias_video', [
            'video_id' => $entity->id(),
            'file_path' => 'test2.mp4',
            'media_status' => (string) MediaStatus::COMPLETE->value,
            'encoded_path' => 'test2.xpto',
        ]);

        $this->assertNotNull($entityDb->trailerFile());
    }

    public function testInsertWithMediaVideo()
    {
        $entity = new Video(
            title: 'Test',
            description: 'Test',
            yearLaunched: 2026,
            duration: 1,
            opened: true,
            rating: Rating::L,
            videoFile: new Media(
                filePath: 'test.mp4',
                mediaStatus: MediaStatus::PROCESSING,
            ),
        );
        $this->repository->insert($entity);

        $this->assertDatabaseCount('medias_video', 0);
        $this->repository->updateMedia($entity);
        $this->assertDatabaseHas('medias_video', [
            'video_id' => $entity->id(),
            'file_path' => 'test.mp4',
            'media_status' => (string) MediaStatus::PROCESSING->value,
        ]);

        $entity->setVideoFile(new Media(
            filePath: 'test2.mp4',
            mediaStatus: MediaStatus::COMPLETE,
            encodedPath: 'test2.xpto',
        ));

        $entityDb = $this->repository->updateMedia($entity);
        $this->assertDatabaseCount('medias_video', 1);
        $this->assertDatabaseHas('medias_video', [
            'video_id' => $entity->id(),
            'file_path' => 'test2.mp4',
            'media_status' => (string) MediaStatus::COMPLETE->value,
            'encoded_path' => 'test2.xpto',
        ]);

        $this->assertNotNull($entityDb->videoFile());
    }

    public function testInsertWithImageBanner()
    {
        $entity = new Video(
            title: 'Test',
            description: 'Test',
            yearLaunched: 2026,
            duration: 1,
            opened: true,
            rating: Rating::L,
            bannerFile: new Image(
                path: 'test.jpg',
            ),
        );
        $this->repository->insert($entity);
        $this->assertDatabaseCount('images_video', 0);

        $this->repository->updateMedia($entity);
        $this->assertDatabaseHas('images_video', [
            'video_id' => $entity->id(),
            'path' => 'test.jpg',
            'type' => (string) ImageTypes::BANNER->value,
        ]);

        $entity->setBannerFile(new Image(
            path: 'test2.jpg',
        ));
        $entityDb = $this->repository->updateMedia($entity);
        $this->assertDatabaseHas('images_video', [
            'video_id' => $entity->id(),
            'path' => 'test2.jpg',
            'type' => (string) ImageTypes::BANNER->value,
        ]);
        $this->assertDatabaseCount('images_video', 1);

        $this->assertNotNull($entityDb->bannerFile());
    }

    public function testInsertWithImageThumb()
    {
        $entity = new Video(
            title: 'Test',
            description: 'Test',
            yearLaunched: 2026,
            duration: 1,
            opened: true,
            rating: Rating::L,
            thumbFile: new Image(
                path: 'test.jpg',
            ),
        );
        $this->repository->insert($entity);
        $this->assertDatabaseCount('images_video', 0);

        $this->repository->updateMedia($entity);
        $this->assertDatabaseHas('images_video', [
            'video_id' => $entity->id(),
            'path' => 'test.jpg',
            'type' => (string) ImageTypes::THUMB->value,
        ]);

        $entity->setThumbFile(new Image(
            path: 'test2.jpg',
        ));
        $entityDb = $this->repository->updateMedia($entity);
        $this->assertDatabaseHas('images_video', [
            'video_id' => $entity->id(),
            'path' => 'test2.jpg',
            'type' => (string) ImageTypes::THUMB->value,
        ]);
        $this->assertDatabaseCount('images_video', 1);

        $this->assertNotNull($entityDb->thumbFile());
    }

    public function testInsertWithImageThumbHalf()
    {
        $entity = new Video(
            title: 'Test',
            description: 'Test',
            yearLaunched: 2026,
            duration: 1,
            opened: true,
            rating: Rating::L,
            thumbHalf: new Image(
                path: 'test.jpg',
            ),
        );
        $this->repository->insert($entity);
        $this->assertDatabaseCount('images_video', 0);

        $this->repository->updateMedia($entity);
        $this->assertDatabaseHas('images_video', [
            'video_id' => $entity->id(),
            'path' => 'test.jpg',
            'type' => (string) ImageTypes::THUMB_HALF->value,
        ]);

        $entity->setThumbHalf(new Image(
            path: 'test2.jpg',
        ));
        $entityDb = $this->repository->updateMedia($entity);
        $this->assertDatabaseHas('images_video', [
            'video_id' => $entity->id(),
            'path' => 'test2.jpg',
            'type' => (string) ImageTypes::THUMB_HALF->value,
        ]);
        $this->assertDatabaseCount('images_video', 1);

        $this->assertNotNull($entityDb->thumbHalf());
    }
}
