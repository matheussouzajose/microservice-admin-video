<?php

namespace App\Http\Controllers\Api\Category;

use App\Adapters\ApiAdapter;
use App\Http\Controllers\Controller;
use Core\Domain\UseCases\Category\PaginateCategoriesUseCaseInterface;
use Core\Intermediate\Dtos\Category\PaginateCategoriesInputDto;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PaginateCategoriesController extends Controller
{
    public function __construct(private readonly PaginateCategoriesUseCaseInterface $useCase)
    {
    }

    public function __invoke(Request $request): AnonymousResourceCollection
    {
        $response = $this->useCase->execute(
            input: new PaginateCategoriesInputDto(
                filter: (string) $request->get('filter', ''),
                order: (string) $request->get('order', 'DESC'),
                page: (int) $request->get('page', 1),
                totalPage: (int) $request->get('total_page', 15),
            )
        );

        return (new ApiAdapter($response))->toJson();
    }
}
