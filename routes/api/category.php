<?php

use App\Http\Controllers\Api\Category\CreateCategoryController;
use App\Http\Controllers\Api\Category\DeleteCategoryController;
use App\Http\Controllers\Api\Category\ListCategoryController;
use App\Http\Controllers\Api\Category\PaginateCategoriesController;
use App\Http\Controllers\Api\Category\UpdateCategoryController;
use Illuminate\Support\Facades\Route;

Route::get('categories/{id}', [ListCategoryController::class, '__invoke']);
Route::get('categories', [PaginateCategoriesController::class, '__invoke']);
Route::post('categories', [CreateCategoryController::class, '__invoke']);
Route::put('categories/{id}', [UpdateCategoryController::class, '__invoke']);
Route::delete('categories/{id}', [DeleteCategoryController::class, '__invoke']);
