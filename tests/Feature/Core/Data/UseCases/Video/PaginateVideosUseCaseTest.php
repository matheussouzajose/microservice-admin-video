<?php

namespace Feature\Core\Data\UseCases\Video;

use App\Models\Video;
use Core\Data\UseCases\Video\Paginate\DTO\PaginateVideosInputDto;
use Core\Data\UseCases\Video\Paginate\PaginateVideosUseCase;
use Core\Domain\Repository\VideoRepositoryInterface;
use Tests\TestCase;

class PaginateVideosUseCaseTest extends TestCase
{
    /**
     * @dataProvider provider
     */
    public function test_pagination(
        int $total,
        int $perPage,
    ) {
        Video::factory()->count($total)->create();

        $useCase = new PaginateVideosUseCase(
            $this->app->make(VideoRepositoryInterface::class)
        );

        $response = $useCase->execute(new PaginateVideosInputDto(
            filter: '',
            order: 'desc',
            page: 1,
            totalPerPage: $perPage
        ));

        $this->assertCount($perPage, $response->items());
        $this->assertEquals($total, $response->total());
    }

    protected function provider(): array
    {
        return [
            [
                'total' => 30,
                'perPage' => 10,
            ], [
                'total' => 20,
                'perPage' => 5,
            ], [
                'total' => 0,
                'perPage' => 0,
            ],
        ];
    }
}
