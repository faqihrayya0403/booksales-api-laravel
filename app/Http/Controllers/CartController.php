<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CartController extends Controller
{
    // Menampilkan keranjang
    public function index()
    {
        $cart = session()->get('cart', []);

        $books = Book::whereIn('id', array_keys($cart))->get();

        $total = 0;

        foreach ($books as $book) {
            $book->quantity = $cart[$book->id];
            $book->subtotal = $book->price * $book->quantity;
            $total += $book->subtotal;
        }

        return view('cart.index', compact('books', 'total'));
    }

    // Menambahkan buku ke keranjang
    public function add(Request $request, $id)
    {
        $request->validate([
            'quantity' => ['nullable', 'integer', 'min:1'],
        ]);

        $book = Book::findOrFail($id);

        $quantity = (int) $request->input('quantity', 1);

        $cart = session()->get('cart', []);

        $newQuantity = ($cart[$id] ?? 0) + $quantity;

        if ($newQuantity > $book->stock) {
            return back()->with(
                'error',
                'Jumlah buku melebihi stok yang tersedia.'
            );
        }

        $cart[$id] = $newQuantity;

        session()->put('cart', $cart);

        return redirect()
            ->route('cart.index')
            ->with('success', 'Buku berhasil ditambahkan ke keranjang.');
    }

    // Mengubah jumlah buku
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $book = Book::findOrFail($id);

        $quantity = (int) $request->quantity;

        if ($quantity > $book->stock) {
            return back()->with(
                'error',
                'Jumlah buku melebihi stok yang tersedia.'
            );
        }

        $cart = session()->get('cart', []);

        if (!array_key_exists($id, $cart)) {
            return back()->with('error', 'Buku tidak ditemukan di keranjang.');
        }

        $cart[$id] = $quantity;

        session()->put('cart', $cart);

        return back()->with('success', 'Jumlah buku berhasil diperbarui.');
    }

    // Menghapus buku dari keranjang
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        unset($cart[$id]);

        session()->put('cart', $cart);

        return back()->with('success', 'Buku berhasil dihapus dari keranjang.');
    }

    // Checkout dan menyimpan transaksi
    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Keranjang belanja masih kosong.');
        }

        try {
            DB::transaction(function () use ($cart, $request) {

                foreach ($cart as $bookId => $quantity) {

                    $book = Book::where('id', $bookId)
                        ->lockForUpdate()
                        ->first();

                    if (!$book) {
                        throw new \Exception(
                            'Salah satu buku tidak ditemukan.'
                        );
                    }

                    if ($quantity < 1 || $quantity > $book->stock) {
                        throw new \Exception(
                            'Stok buku "' . $book->title .
                            '" tidak mencukupi.'
                        );
                    }

                    $totalAmount = $book->price * $quantity;

                    Transaction::create([
                        'order_number' => 'TRX-' . strtoupper(Str::random(10)),
                        'customer_id' => $request->user()->id,
                        'book_id' => $book->id,
                        'quantity' => $quantity,
                        'total_amount' => $totalAmount,
                    ]);

                    // Mengurangi stok buku
                    $book->decrement('stock', $quantity);
                }
            });

        } catch (\Exception $e) {
            return redirect()
                ->route('cart.index')
                ->with('error', $e->getMessage());
        }

        // Mengosongkan keranjang setelah transaksi berhasil
        session()->forget('cart');

        return redirect()
            ->route('cart.index')
            ->with(
                'success',
                'Checkout berhasil! Pesanan dibuat dengan metode pembayaran Bayar di Tempat (COD).'
            );
    }
}
