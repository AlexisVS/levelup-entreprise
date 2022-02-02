<?php

use App\Http\Controllers\api\LoginController;
use App\Http\Controllers\auth\LogoutController;
use App\Http\Controllers\api\RegisterController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Broadcast;
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

Broadcast::routes(['middleware' => ['auth:sanctum']]);

Route::post('/v1/register/validate-step-one', [RegisterController::class, 'register1']);
Route::post('/v1/login', [LoginController::class, 'login']);

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::get('/logout', [LogoutController::class, 'logout']);
    Route::get('/profile', [UserController::class, 'getUser']);
    Route::post('edit-profile', [UserController::class, 'editProfile']);

    Route::post('/register/validate-step-two', [RegisterController::class, 'register2']);
    Route::post('/register/validate-step-three', [RegisterController::class, 'register3']);

    Route::apiResource('/todos', TodoController::class)->except(['store', 'update', 'destroy']);
    Route::get('/todos/{todoId}/done', [TodoController::class, 'done']);

    Route::get('/messages', [MessageController::class, 'index']);
    Route::post('/messages', [MessageController::class, 'store']);
    Route::get('/messages/{messageId}', [MessageController::class, 'update']);
});
