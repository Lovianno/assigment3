<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
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

// Route::group(['middleware' => 'auth:api'], function(){
    Route::get('/todo', [TodoController::class, 'showTodo']);
    Route::post('/todo', [TodoController::class, 'createTodo']);
    Route::put('/todo', [TodoController::class, 'updateTodo']);
    Route::delete('/todo', [TodoController::class, 'deleteTodo']);
// });


Route::group([
    'prefix' => 'auth'
], function(){
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::group(['middleware' => 'auth:api'], function(){
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/data', [AuthController::class, 'data']);
        Route::post('/refresh', [AuthController::class, 'refresh']);
    });
});