<?php

use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Api\BookCategoryController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\PostCategoryController;
use App\Http\Controllers\Api\TagController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->group(function () {
    Route::get('/', function (Request $request) {
        return ([
            'message' => 'Olá, Guana!'
        ]);
    });

    // Public Routes
    Route::apiResource('posts', PostController::class)->only(['index', 'show']);
    Route::apiResource('books', BookController::class)->only(['index', 'show']);
    Route::apiResource('post-categories', PostCategoryController::class)->only(['index']);
    Route::apiResource('book-categories', BookCategoryController::class)->only(['index']);
    Route::apiResource('tags', TagController::class);

    // Post Actions (Public)
    Route::post('posts/{post}/like', [PostController::class, 'like']);
    Route::post('posts/{post}/unlike', [PostController::class, 'unlike']);
    Route::post('posts/{post}/share', [PostController::class, 'share']);
    Route::get('posts/{post}/analytics', [PostController::class, 'analytics']);

    // Book Actions (Public)
    Route::post('books/{book}/favorite', [BookController::class, 'favorite']);
    Route::post('books/{book}/unfavorite', [BookController::class, 'unfavorite']);
    Route::post('books/{book}/download', [BookController::class, 'download']);
    Route::post('books/{book}/share', [BookController::class, 'share']);

    // Comments (Public)
    Route::post('posts/{post}/comments', [CommentController::class, 'store']);
    Route::apiResource('comments', CommentController::class)->only(['destroy']);
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/user.php';
