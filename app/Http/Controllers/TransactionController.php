<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    // Customer membuat transaksi
    public function store(Request $request)
    {
        $validated = $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        $book = Book::findOrFail($validated['book_id']);

        if ($book->stock < 1) {
            return response()->json([
                'message' => 'Stok buku tidak tersedia.',
            ], 422);
        }

        $transaction = Transaction::create([
            'order_number' => 'TRX-' . strtoupper(Str::random(10)),
            'customer_id' => $request->user()->id,
            'book_id' => $book->id,
            'total_amount' => $book->price,
        ]);

        $book->decrement('stock');

        return response()->json([
            'message' => 'Transaksi berhasil dibuat.',
            'data' => $transaction->load(['customer', 'book']),
        ], 201);
    }

    // Customer melihat transaksi miliknya
    public function show(Request $request, string $id)
    {
        $transaction = Transaction::with(['customer', 'book'])
            ->where('customer_id', $request->user()->id)
            ->findOrFail($id);

        return response()->json([
            'message' => 'Detail transaksi berhasil diambil.',
            'data' => $transaction,
        ]);
    }

    // Customer mengubah transaksi miliknya
    public function update(Request $request, string $id)
    {
        $transaction = Transaction::where(
            'customer_id',
            $request->user()->id
        )->findOrFail($id);

        $validated = $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        $newBook = Book::findOrFail($validated['book_id']);
        $oldBook = Book::findOrFail($transaction->book_id);

        if ($newBook->id !== $oldBook->id && $newBook->stock < 1) {
            return response()->json([
                'message' => 'Stok buku baru tidak tersedia.',
            ], 422);
        }

        if ($newBook->id !== $oldBook->id) {
            $oldBook->increment('stock');
            $newBook->decrement('stock');
        }

        $transaction->update([
            'book_id' => $newBook->id,
            'total_amount' => $newBook->price,
        ]);

        return response()->json([
            'message' => 'Transaksi berhasil diperbarui.',
            'data' => $transaction->load(['customer', 'book']),
        ]);
    }

    // Admin melihat semua transaksi
    public function index()
    {
        $transactions = Transaction::with(['customer', 'book'])->get();

        return response()->json([
            'message' => 'Data transaksi berhasil diambil.',
            'data' => $transactions,
        ]);
    }

    // Admin menghapus transaksi
    public function destroy(string $id)
    {
        $transaction = Transaction::findOrFail($id);

        $book = Book::find($transaction->book_id);

        if ($book) {
            $book->increment('stock');
        }

        $transaction->delete();

        return response()->json([
            'message' => 'Transaksi berhasil dihapus.',
        ]);
    }
}
