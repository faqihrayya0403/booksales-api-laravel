<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\GenreController;

// Route login
Route::post('/login', [AuthController::class, 'login']);

// Route buku
Route::get('/books', [BookController::class, 'index']);

// Route publik Author
Route::apiResource('authors', AuthorController::class)
    ->only(['index', 'show']);

// Route publik Genre
Route::apiResource('genres', GenreController::class)
    ->only(['index', 'show']);

// Route yang membutuhkan autentikasi
Route::middleware('auth:sanctum')->group(function () {

    // Logout
    Route::post('/logout', [AuthController::class, 'logout']);

    // Khusus admin
    Route::middleware('role:admin')->group(function () {

        // Author
        Route::apiResource('authors', AuthorController::class)
            ->only(['store', 'update', 'destroy']);

        // Genre
        Route::apiResource('genres', GenreController::class)
            ->only(['store', 'update', 'destroy']);
    });
});
