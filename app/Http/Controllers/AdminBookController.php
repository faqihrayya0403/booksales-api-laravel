<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminBookController extends Controller
{
    // Menampilkan daftar buku
    public function index()
    {
        $books = Book::with(['author', 'genre'])
            ->latest()
            ->paginate(10);

        return view('admin.books.index', compact('books'));
    }

    // Menampilkan form tambah buku
    public function create()
    {
        $authors = Author::orderBy('name')->get();
        $genres = Genre::orderBy('name')->get();

        return view('admin.books.create', compact('authors', 'genres'));
    }

    // Menyimpan buku baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'author_id' => ['required', 'exists:authors,id'],
            'genre_id' => ['required', 'exists:genres,id'],
            'title' => ['required', 'string', 'max:255'],
            'isbn' => ['nullable', 'string', 'max:255', 'unique:books,isbn'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
        ]);

        Book::create($validated);

        return redirect()->route('admin.books.index')
            ->with('success', 'Buku berhasil ditambahkan.');
    }

    // Menampilkan form edit buku
    public function edit(Book $book)
    {
        $authors = Author::orderBy('name')->get();
        $genres = Genre::orderBy('name')->get();

        return view('admin.books.edit', compact(
            'book',
            'authors',
            'genres'
        ));
    }

    // Memperbarui buku
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'author_id' => ['required', 'exists:authors,id'],
            'genre_id' => ['required', 'exists:genres,id'],
            'title' => ['required', 'string', 'max:255'],
            'isbn' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('books', 'isbn')->ignore($book->id),
            ],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
        ]);

        $book->update($validated);

        return redirect()->route('admin.books.index')
            ->with('success', 'Buku berhasil diperbarui.');
    }

    // Menghapus buku
    public function destroy(Book $book)
    {
        if ($book->transactions()->exists()) {
            return redirect()->route('admin.books.index')
                ->with('error', 'Buku tidak bisa dihapus karena sudah memiliki transaksi.');
        }

        $book->delete();

        return redirect()->route('admin.books.index')
            ->with('success', 'Buku berhasil dihapus.');
    }
}
