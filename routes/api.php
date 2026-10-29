<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\GenreController;

// Route buku tetap dipertahankan
Route::get('/books', [BookController::class, 'index']);

// Route API Resource untuk Author dan Genre
Route::apiResource('authors', AuthorController::class);
Route::apiResource('genres', GenreController::class);
