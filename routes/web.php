<?php

use App\Http\Controllers\admin\MessageController;
use App\Http\Controllers\admin\TodoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/todos', [TodoController::class, 'index']);
Route::post('/todos/{userId}', [TodoController::class, 'store']);

Route::get('/messages', [MessageController::class, 'index']);
Route::post('/messages/{userId}', [MessageController::class, 'store']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
