<?php

use Illuminate\Support\Facades\Log;
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
//
//Route::get('/me', function () {
//    Log::warning('test');
//
//    $user = \App\Models\User::factory()->create([
//        'email_verified_at' => null
//    ]);
//
//    event(new \Core\Domain\Event\UserCreatedEvent(
//        user: new \Core\Domain\Entity\User(
//            firstName: 'Matheus',
//            lastName: 'Jose',
//            email: 'matheussouzajose97@gmail.com'
//        )
//    ));
//    return response()->json(['message' => 'mse']);
//});

Route::prefix('v1')->group(function () {

    Route::group([], base_path('routes/api/auth.php'));

    Route::middleware(['auth:api', /*'can:admin-catalog'*/])->group(function () {
        Route::get('/me', function () {
            return response()->json(['message' => 'mse']);
        });

        Route::group([], base_path('routes/api/category.php'));
        Route::group([], base_path('routes/api/genre.php'));
        Route::group([], base_path('routes/api/castMember.php'));
        Route::group([], base_path('routes/api/video.php'));
    });
});

Route::get('/', function () {
    return response()->json(['message' => 'success']);
});
