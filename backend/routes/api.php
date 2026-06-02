<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    // return $request->user();
    return $request->json([
        'message' => 'Olá, Guana!'
    ]);
})->middleware('auth:sanctum');

Route::get('/', function (Request $request) {
    return ([
        'message' => 'Olá, Guana!'
    ]);
});
