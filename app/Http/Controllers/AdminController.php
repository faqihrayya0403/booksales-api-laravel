<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Genre;
use App\Models\Transaction;

class AdminController extends Controller
{
    public function index()
    {
        $totalBooks = Book::count();
        $totalUsers = User::count();
        $totalGenres = Genre::count();
        $totalTransactions = Transaction::count();

        return view('admin.dashboard', compact(
            'totalBooks',
            'totalUsers',
            'totalGenres',
            'totalTransactions'
        ));
    }
}
