<?php

namespace Tests\Unit\App\Http\Controlles\Api;

use App\Http\Controllers\Api\Category\PaginateCategoriesController;
use Core\Application\UseCases\Category\PaginateCategoriesUseCase;
use Core\Domain\Repository\PaginationInterface;
use Illuminate\Http\Request;
use Tests\TestCase;

class ListCategoriesControllerUnitTest extends TestCase
{
    public function testListCategories()
    {
        $request = \Mockery::mock(Request::class);
        $request->shouldReceive('get')->andReturn('input');

        $categoriesListOutputDto = \Mockery::mock(PaginationInterface::class);
        $categoriesListOutputDto->shouldReceive('items');
        $categoriesListOutputDto->shouldReceive('firstPage');
        $categoriesListOutputDto->shouldReceive('lastPage');
        $categoriesListOutputDto->shouldReceive('currentPage');
        $categoriesListOutputDto->shouldReceive('total');
        $categoriesListOutputDto->shouldReceive('from');
        $categoriesListOutputDto->shouldReceive('to');
        $categoriesListOutputDto->shouldReceive('perPage');

        $listCategoriesUseCase = \Mockery::mock(PaginateCategoriesUseCase::class);
        $listCategoriesUseCase->shouldReceive('execute')->andReturn($categoriesListOutputDto);

        $response = (new PaginateCategoriesController($listCategoriesUseCase))($request);

        $this->assertIsObject($response->resource);
        $this->assertArrayHasKey('meta', $response->additional);
    }
}
