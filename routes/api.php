<?php

use App\Api\V1\Controllers\MessageController;
use App\Api\V1\Controllers\SubscribersController;
use App\Api\V1\Controllers\SubscriptionController;
use App\Api\V1\Controllers\TopicsController;
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

Route::resource('subscribers', SubscribersController::class);

Route::resource('topics', TopicsController::class);

//publisher server endpoints
Route::post('/subscribe/{topic}', [SubscriptionController::class, 'subscribe']);

Route::post('/publish/{topic}', [MessageController::class, 'publish']);
