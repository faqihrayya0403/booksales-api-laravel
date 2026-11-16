<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Database\QueryException;

class BookController extends Controller
{
    // Menampilkan semua buku
    public function index()
    {
        $books = Book::with('author')->get();

        return response()->json([
            'success' => true,
            'message' => 'Data buku berhasil diambil',
            'data' => $books
        ], 200);
    }

    // Menampilkan detail buku
    public function show($id)
    {
        $book = Book::with('author')->find($id);

        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Buku tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail buku berhasil diambil',
            'data' => $book
        ], 200);
    }

    // Menambahkan buku
    public function store(Request $request)
    {
        $validated = $request->validate([
            'author_id' => 'required|exists:authors,id',
            'title' => 'required|string|max:255',
            'isbn' => 'nullable|string|unique:books,isbn',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
        ]);

        $book = Book::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Buku berhasil ditambahkan',
            'data' => $book
        ], 201);
    }

    // Memperbarui buku
    public function update(Request $request, $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Buku tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'author_id' => 'sometimes|required|exists:authors,id',
            'title' => 'sometimes|required|string|max:255',
            'isbn' => [
                'sometimes',
                'nullable',
                'string',
                Rule::unique('books', 'isbn')->ignore($book->id)
            ],
            'price' => 'sometimes|required|numeric|min:0',
            'stock' => 'sometimes|required|integer|min:0',
            'description' => 'sometimes|nullable|string',
        ]);

        $book->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Buku berhasil diperbarui',
            'data' => $book->load('author')
        ], 200);
    }

    // Menghapus buku
    public function destroy($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Buku tidak ditemukan'
            ], 404);
        }

        try {
            $book->delete();

            return response()->json([
                'success' => true,
                'message' => 'Buku berhasil dihapus'
            ], 200);

        } catch (QueryException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Buku tidak dapat dihapus karena masih memiliki transaksi'
            ], 409);
        }
    }
}
