<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\TransactionController;

// Route login
// Route registrasi dan login
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
// Route buku
Route::get('/books', [BookController::class, 'index']);
Route::get('/books/{id}', [BookController::class, 'show']);

// Khusus admin
Route::middleware('auth:sanctum')->group(function () {
    Route::middleware('role:admin')->group(function () {
        Route::post('/books', [BookController::class, 'store']);
        Route::put('/books/{id}', [BookController::class, 'update']);
        Route::delete('/books/{id}', [BookController::class, 'destroy']);
    });
});

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

    // Khusus user/customer
    Route::middleware('role:user')->group(function () {
        Route::post('/transactions', [TransactionController::class, 'store']);
        Route::get('/transactions/{id}', [TransactionController::class, 'show']);
        Route::put('/transactions/{id}', [TransactionController::class, 'update']);
    });

    // Khusus admin
    Route::middleware('role:admin')->group(function () {

        // Author
        Route::apiResource('authors', AuthorController::class)
            ->only(['store', 'update', 'destroy']);

        // Genre
        Route::apiResource('genres', GenreController::class)
            ->only(['store', 'update', 'destroy']);

        // Transaction
        Route::get('/transactions', [TransactionController::class, 'index']);
        Route::delete('/transactions/{id}', [TransactionController::class, 'destroy']);
    });
});
