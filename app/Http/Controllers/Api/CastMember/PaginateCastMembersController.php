<?php

namespace App\Http\Controllers\Api\CastMember;

use App\Adapters\ApiAdapter;
use App\Http\Controllers\Controller;
use Core\Data\UseCases\CastMember\Paginate\DTO\PaginateCastMembersInputDto;
use Core\Data\UseCases\CastMember\Paginate\PaginateCastMembersUseCaseInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PaginateCastMembersController extends Controller
{
    public function __construct(private readonly PaginateCastMembersUseCaseInterface $useCase)
    {
    }

    public function __invoke(Request $request): AnonymousResourceCollection
    {
        $response = $this->useCase->execute(
            input: new PaginateCastMembersInputDto(
                filter: (string) $request->get('filter', ''),
                order: (string) $request->get('order', 'DESC'),
                page: (int) $request->get('page', 1),
                totalPerPage: (int) $request->get('total_page', 15),
            )
        );

        return (new ApiAdapter($response))->toJson();
    }
}
