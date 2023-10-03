<?php

use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\RefreshTokenController;
use App\Http\Controllers\Api\Auth\SignInController;
use App\Http\Controllers\Api\Auth\SignUpController;
use Illuminate\Support\Facades\Route;

Route::post('sign-up', array(SignUpController::class, '__invoke'));
Route::post('sign-in', array(SignInController::class, '__invoke'));

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', array(LogoutController::class, '__invoke'));
    Route::post('refresh', array(RefreshTokenController::class, '__invoke'));
});
