<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
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

Route::prefix('v1')->group(function () {    
    Route::post('/login', [LoginController::class, 'login']);
    Route::post( '/register/validate-step-one' ,[RegisterController::class, 'register1']);
    Route::post( '/register/validate-step-two' ,[RegisterController::class, 'register2']);
    Route::post( '/register/validate-step-three' ,[RegisterController::class, 'register3']);
});