<?php

use App\Http\Controllers\Api\CastMember\CreateCastMemberController;
use App\Http\Controllers\Api\CastMember\DeleteCastMemberController;
use App\Http\Controllers\Api\CastMember\PaginateCastMembersController;
use App\Http\Controllers\Api\CastMember\ListCastMemberController;
use App\Http\Controllers\Api\CastMember\UpdateCastMemberController;
use Illuminate\Support\Facades\Route;

Route::get('cast_members/{id}', [ListCastMemberController::class, '__invoke']);
Route::get('cast_members', [PaginateCastMembersController::class, '__invoke']);
Route::post('cast_members', [CreateCastMemberController::class, '__invoke']);
Route::put('cast_members/{id}', [UpdateCastMemberController::class, '__invoke']);
Route::delete('cast_members/{id}', [DeleteCastMemberController::class, '__invoke']);
