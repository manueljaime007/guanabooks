<?php

use App\Http\Controllers\User\ProfileController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->prefix('v1/user')->group(function () {
    Route::get('profile', [ProfileController::class, 'profile']);
    Route::patch('profile', [ProfileController::class, 'updateProfile']);
    Route::get('stats', [ProfileController::class, 'stats']);
});
