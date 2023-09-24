<?php

use App\Http\Controllers\Api\Video\CreateVideoController;
use App\Http\Controllers\Api\Video\DeleteVideoController;
use App\Http\Controllers\Api\Video\PaginateVideosController;
use App\Http\Controllers\Api\Video\ListVideoController;
use App\Http\Controllers\Api\Video\UpdateVideoController;
use Illuminate\Support\Facades\Route;

Route::get('videos/{id}', [ListVideoController::class, '__invoke']);
Route::get('videos', [PaginateVideosController::class, '__invoke']);
Route::post('videos', [CreateVideoController::class, '__invoke']);
Route::put('videos/{id}', [UpdateVideoController::class, '__invoke']);
Route::delete('videos/{id}', [DeleteVideoController::class, '__invoke']);
