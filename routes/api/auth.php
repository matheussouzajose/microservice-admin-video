<?php

use App\Http\Controllers\Api\Auth\SignInController;
use App\Http\Controllers\Api\Auth\SignUpController;
use Illuminate\Support\Facades\Route;

Route::post('sign-up', array(SignUpController::class, '__invoke'));
Route::post('sign-in', array(SignInController::class, '__invoke'));
