<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MessageController;

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

Route::prefix('/v1')->group(function(){
    Route::get('test', [MessageController::class, 'testFunction']);

    Route::prefix('messages')->group(function(){
        Route::get('/', [MessageController::class, 'getMessages']);
        Route::post('set-message', [MessageController::class, 'setMessage']);
        Route::delete('{message_id}', [MessageController::class, 'deleteMessage']);
        Route::post('edit', [MessageController::class, 'editMessage']);
    });
});