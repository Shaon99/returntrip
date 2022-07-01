<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('page')->group(function () {
        Route::post('create', [PageController::class, 'createPage']);
        Route::post('{pageId}/attach-post', [PageController::class, 'pageAttachPost']);
    });

    Route::prefix('follow')->group(function () {
        Route::post('person/{personid}', [PageController::class, 'followPerson']);
        Route::post('page/{pageid}', [PageController::class, 'followPage']);
    });

    Route::prefix('person')->group(function () {
        Route::post('attach-post', [PageController::class, 'attachPost']);
        Route::get('feed', [PageController::class, 'feed'])->name('feed');


    });
});
