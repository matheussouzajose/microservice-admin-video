<?php

namespace App\Http\Controllers\Api\Genre;

use App\Adapters\ApiAdapter;
use App\Http\Controllers\Controller;
use App\Http\Resources\GenreResource;
use Core\Data\UseCases\Genre\Paginate\DTO\PaginateGenresInputDto;
use Core\Data\UseCases\Genre\Paginate\PaginateGenresUseCaseInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PaginateGenresController extends Controller
{
    /**
     * @param PaginateGenresUseCaseInterface $useCase
     */
    public function __construct(private readonly PaginateGenresUseCaseInterface $useCase)
    {
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function __invoke(Request $request): AnonymousResourceCollection
    {
        $response = $this->useCase->execute(
            input: new PaginateGenresInputDto(
                filter: (string)$request->get('filter', ''),
                order: (string)$request->get('order', 'DESC'),
                page: (int)$request->get('page', 1),
                totalPage: (int)$request->get('total_page', 15),
            )
        );

        return (new ApiAdapter($response, GenreResource::class))->toJson();
    }
}
