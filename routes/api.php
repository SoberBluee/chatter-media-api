<?php

use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MessageController;
use App\Http\Controllers\PostController;

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

Route::prefix('/v1')->group(function () {
    Route::get('test', [MessageController::class, 'testFunction']);

    Route::prefix('messages')->group(function () {
        Route::get('/', [MessageController::class, 'getMessages']);
        Route::post('set-message', [MessageController::class, 'setMessage']);
        Route::delete('{message_id}', [MessageController::class, 'deleteMessages']);
        Route::post('edit', [MessageController::class, 'editMessage']);
    });

    Route::prefix('posts')->group(function () {
        Route::get('get-all-posts', [PostController::class, 'getAllPosts']);
        Route::post('create-post', [PostController::class, 'setPost']);
        Route::get('{post_id}', [PostController::class, 'getPost']);
        Route::delete('{post_id}', [PostController::class, 'deletePost']);
        Route::post('/edit', [PostController::class, 'editPost']);
        Route::post('{postId}/comment', [CommentController::class, 'setComment']);
    });
});
