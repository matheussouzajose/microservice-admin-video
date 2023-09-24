<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->middleware(['auth:api', 'can:admin-catalog'])->group(function () {
    Route::get('/me', function () {
        return response()->json(['message' => 'mse']);
    });

    Route::group([], base_path('routes/api/category.php'));
    Route::group([], base_path('routes/api/genre.php'));
    Route::group([], base_path('routes/api/castMember.php'));
    Route::group([], base_path('routes/api/video.php'));
});


Route::get('/', function () {
    return response()->json(['message' => 'success']);
});
