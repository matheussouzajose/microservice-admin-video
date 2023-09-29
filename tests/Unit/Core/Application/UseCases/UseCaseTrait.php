<?php

namespace Tests\Unit\Core\Application\UseCases;

use Core\Domain\Repository\PaginationInterface;
use Mockery\LegacyMockInterface;
use Mockery\MockInterface;

trait UseCaseTrait
{
    protected function mockPagination(array $items = []): MockInterface|PaginationInterface|LegacyMockInterface|\stdClass
    {
        $mockPagination = \Mockery::mock(\stdClass::class, PaginationInterface::class);
        $mockPagination->shouldReceive('items')->andReturn($items);
        $mockPagination->shouldReceive('total')->andReturn(0);
        $mockPagination->shouldReceive('currentPage')->andReturn(0);
        $mockPagination->shouldReceive('firstPage')->andReturn(0);
        $mockPagination->shouldReceive('lastPage')->andReturn(0);
        $mockPagination->shouldReceive('perPage')->andReturn(0);
        $mockPagination->shouldReceive('to')->andReturn(0);
        $mockPagination->shouldReceive('from')->andReturn(0);

        return $mockPagination;
    }
}
