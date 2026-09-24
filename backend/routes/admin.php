<?php

use App\Http\Controllers\Admin\CommentModerationController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\TagController as AdminTagController;
use App\Http\Controllers\Api\BookCategoryController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Admin\PostCategoryController as AdminPostCategoryController;
use App\Http\Controllers\Api\TagController;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->group(function () {
    Route::middleware(['auth:sanctum', 'can:admin'])->prefix('admin')->group(function () {
        Route::get('posts/{slug}', [AdminPostController::class, 'show'])
            ->where('slug', '[a-z0-9\-]+')
            ->name('posts.show');
        // Route::patch('posts/{slug}', [AdminPostController::class, 'update']);
        Route::apiResource('posts', AdminPostController::class);
        Route::apiResource('books', BookController::class)->except(['show']);
        Route::apiResource('post-categories', AdminPostCategoryController::class);
        Route::apiResource('book-categories', BookCategoryController::class);
        Route::apiResource('tags', AdminTagController::class);

        // Comment Moderation
        Route::apiResource('comments', CommentModerationController::class)->only(['index', 'update', 'destroy']);

        // Analytics
        Route::get('analytics/posts', [AdminPostController::class, 'analyticsAll']);
        Route::get('analytics/books', [BookController::class, 'analyticsAll']);
    });
});
