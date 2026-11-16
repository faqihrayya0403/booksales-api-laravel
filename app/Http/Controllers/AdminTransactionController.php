<?php

namespace App\Http\Controllers;

use App\Models\Transaction;

class AdminTransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['customer', 'book'])
            ->latest()
            ->paginate(10);

        return view('admin.transactions.index', compact('transactions'));
    }
}
