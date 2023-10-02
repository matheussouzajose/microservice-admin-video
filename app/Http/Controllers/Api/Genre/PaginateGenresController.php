<?php

namespace App\Http\Controllers\Api\Genre;

use App\Adapters\ApiAdapter;
use App\Http\Controllers\Controller;
use App\Http\Resources\GenreResource;
use Core\Domain\UseCases\Genre\PaginateGenresUseCaseInterface;
use Core\Intermediate\Dtos\Genre\PaginateGenresInputDto;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PaginateGenresController extends Controller
{
    public function __construct(private readonly PaginateGenresUseCaseInterface $useCase)
    {
    }

    public function __invoke(Request $request): AnonymousResourceCollection
    {
        $response = $this->useCase->execute(
            input: new PaginateGenresInputDto(
                filter: (string) $request->get('filter', ''),
                order: (string) $request->get('order', 'DESC'),
                page: (int) $request->get('page', 1),
                totalPage: (int) $request->get('total_page', 15),
            )
        );

        return (new ApiAdapter($response, GenreResource::class))->toJson();
    }
}
