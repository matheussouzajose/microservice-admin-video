<?php

namespace Tests\Feature\Core\Data\UseCases\Category;


use App\Models\Category as CategoryModel;
use App\Repositories\Eloquent\CategoryEloquentRepository;
use Core\Data\UseCases\Category\List\DTO\ListCategoryInputDto;
use Core\Data\UseCases\Category\List\ListCategoryUseCase;
use Tests\TestCase;

class ListCategoryUseCaseFeatureTest extends TestCase
{
    public function testListCategory()
    {
        $categoryDb = CategoryModel::factory()->create();

        $model = new CategoryModel();
        $repository = new CategoryEloquentRepository($model);
        $useCase = new ListCategoryUseCase($repository);
        $response = $useCase->execute(new ListCategoryInputDto(id: $categoryDb->id));

        $this->assertEquals($categoryDb->id, $response->id);
        $this->assertEquals($categoryDb->name, $response->name);
        $this->assertEquals($categoryDb->description, $response->description);
    }
}
