<?php

use App\Http\Controllers\API\PassportController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\RestfulApiController;
use Illuminate\Http\Request;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('v1')->group(function () {
    Route::post('register', [PassportController::class, 'register']);
    Route::post('login', [PassportController::class, 'login']);
    Route::name('api.')->group(function() {
        Route::apiResource('posts', PostController::class)->middleware('auth:api');
    });
});

