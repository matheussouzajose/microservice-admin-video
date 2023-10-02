<?php

use App\Http\Controllers\Api\Auth\SignUpController;
use Illuminate\Support\Facades\Route;

Route::post('sign-up', array(SignUpController::class, '__invoke'));
