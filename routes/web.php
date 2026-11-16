<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WebAuthController;
use App\Http\Controllers\WebBookController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminGenreController;
use App\Http\Controllers\AdminBookController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminTransactionController;
use App\Http\Controllers\AdminMessageController;
use App\Http\Controllers\OrderHistoryController;


// ==============================
// REGISTER
// ==============================

Route::get('/register', [WebAuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [WebAuthController::class, 'register']);


// ==============================
// LOGIN
// ==============================

Route::get('/login', [WebAuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [WebAuthController::class, 'login']);


// ==============================
// LOGOUT
// ==============================

Route::post('/logout', [WebAuthController::class, 'logout'])
    ->name('logout');


// ==============================
// HALAMAN USER
// ==============================

Route::middleware('auth')->group(function () {
    Route::get('/my-orders', [OrderHistoryController::class, 'index'])
    ->name('orders.index');

    // BERANDA
    Route::view('/', 'home')
        ->name('home');

    // KATALOG BUKU
    Route::get('/books', [WebBookController::class, 'index'])
        ->name('books.index');

    // DETAIL BUKU
    Route::get('/books/{id}', [WebBookController::class, 'show'])
        ->name('books.show');

    // ABOUT US
    Route::view('/about', 'about')
        ->name('about');

    // CONTACT ADMIN
    Route::get('/contact', [ContactController::class, 'index'])
        ->name('contact.index');

    Route::post('/contact', [ContactController::class, 'store'])
        ->name('contact.store');

    // ==============================
    // SHOPPING CART
    // ==============================

    Route::get('/cart', [CartController::class, 'index'])
        ->name('cart.index');

    Route::post('/cart/add/{id}', [CartController::class, 'add'])
        ->name('cart.add');

    Route::put('/cart/update/{id}', [CartController::class, 'update'])
        ->name('cart.update');

    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])
        ->name('cart.remove');

    // CHECKOUT
    Route::post('/cart/checkout', [CartController::class, 'checkout'])
        ->name('cart.checkout');

});


// ==============================
// ADMIN
// DASHBOARD, KATEGORI, BUKU,
// PENGGUNA, TRANSAKSI, PESAN
// ==============================

Route::prefix('admin')
    ->middleware(['auth', 'role:admin'])
    ->group(function () {

        // DASHBOARD
        Route::get('/dashboard', [AdminController::class, 'index'])
            ->name('admin.dashboard');

        // CRUD KATEGORI
        Route::get('/genres', [AdminGenreController::class, 'index'])
            ->name('admin.genres.index');

        Route::post('/genres', [AdminGenreController::class, 'store'])
            ->name('admin.genres.store');

        Route::put('/genres/{genre}', [AdminGenreController::class, 'update'])
            ->name('admin.genres.update');

        Route::delete('/genres/{genre}', [AdminGenreController::class, 'destroy'])
            ->name('admin.genres.destroy');

        // CRUD BUKU
        Route::get('/books', [AdminBookController::class, 'index'])
            ->name('admin.books.index');

        Route::get('/books/create', [AdminBookController::class, 'create'])
            ->name('admin.books.create');

        Route::post('/books', [AdminBookController::class, 'store'])
            ->name('admin.books.store');

        Route::get('/books/{book}/edit', [AdminBookController::class, 'edit'])
            ->name('admin.books.edit');

        Route::put('/books/{book}', [AdminBookController::class, 'update'])
            ->name('admin.books.update');

        Route::delete('/books/{book}', [AdminBookController::class, 'destroy'])
            ->name('admin.books.destroy');

        // DAFTAR PENGGUNA
        Route::get('/users', [AdminUserController::class, 'index'])
            ->name('admin.users.index');

        // DAFTAR TRANSAKSI
        Route::get('/transactions', [AdminTransactionController::class, 'index'])
            ->name('admin.transactions.index');

        // DAFTAR PESAN CONTACT ADMIN
        Route::get('/messages', [AdminMessageController::class, 'index'])
            ->name('admin.messages.index');

    });
