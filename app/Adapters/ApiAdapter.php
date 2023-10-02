<?php

namespace App\Adapters;

use App\Http\Resources\DefaultResource;
use Core\Domain\Repository\PaginationInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class ApiAdapter
{
    public function __construct(
        // private ?PaginationInterface $response = null
        protected PaginationInterface $response,
        protected string|JsonResource $resource = ''
    ) {
        $this->validResource($resource);
    }

    private function validResource(string|JsonResource $resource): void
    {
        if (! is_subclass_of($resource, JsonResource::class)) {
            $this->resource = DefaultResource::class;
        }
    }

    public function toJson(): AnonymousResourceCollection
    {
        // if (!$this->response) {
        //     throw new \Exception('Response is null');
        // }

        return $this->resource::collection($this->response->items())
            ->additional([
                'meta' => [
                    'total' => $this->response->total(),
                    'current_page' => $this->response->currentPage(),
                    'last_page' => $this->response->lastPage(),
                    'first_page' => $this->response->firstPage(),
                    'per_page' => $this->response->perPage(),
                    'to' => $this->response->to(),
                    'from' => $this->response->from(),
                ],
            ]);
    }

    public function toXml()
    {
        //
    }

    public static function json(object $data, int $statusCode = 200, array $additional = []): JsonResponse
    {
        return (new DefaultResource($data))
            ->additional($additional)
            ->response()
            ->setStatusCode($statusCode);
    }
}
