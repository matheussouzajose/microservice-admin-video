<?php

use App\Http\Controllers\Api\Genre\CreateGenreController;
use App\Http\Controllers\Api\Genre\DeleteGenreController;
use App\Http\Controllers\Api\Genre\PaginateGenresController;
use App\Http\Controllers\Api\Genre\ListGenreController;
use App\Http\Controllers\Api\Genre\UpdateGenreController;
use Illuminate\Support\Facades\Route;

Route::get('genres/{id}', [ListGenreController::class, '__invoke']);
Route::get('genres', [PaginateGenresController::class, '__invoke']);
Route::post('genres', [CreateGenreController::class, '__invoke']);
Route::put('genres/{id}', [UpdateGenreController::class, '__invoke']);
Route::delete('genres/{id}', [DeleteGenreController::class, '__invoke']);
