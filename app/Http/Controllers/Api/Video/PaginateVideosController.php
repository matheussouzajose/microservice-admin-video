<?php

namespace App\Http\Controllers\Api\Video;

use App\Adapters\ApiAdapter;
use App\Http\Controllers\Controller;
use Core\Data\UseCases\Video\Paginate\DTO\PaginateVideosInputDto;
use Core\Data\UseCases\Video\Paginate\PaginateVideosUseCase;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PaginateVideosController extends Controller
{
    /**
     * @param PaginateVideosUseCase $useCase
     */
    public function __construct(private readonly  PaginateVideosUseCase $useCase)
    {
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function __invoke(Request $request): AnonymousResourceCollection
    {
        $response = $this->useCase->execute(
            input: new PaginateVideosInputDto(
                filter: (string) $request->get('filter'),
                order: (string) $request->get('order', 'DESC'),
                page: (int) $request->get('page', 1),
                totalPerPage: (int) $request->get('per_page', 15)
            )
        );

        return (new ApiAdapter($response))
            ->toJson();
    }
}