<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class WebBookController extends Controller
{
    // Menampilkan katalog buku dan fitur pencarian
    public function index(Request $request)
    {
        $books = Book::with(['author', 'genre'])
            ->when($request->filled('q'), function ($query) use ($request) {
                $keyword = $request->q;

                $query->where(function ($q) use ($keyword) {
                    $q->where('title', 'like', "%{$keyword}%")
                        ->orWhereHas('author', function ($author) use ($keyword) {
                            $author->where('name', 'like', "%{$keyword}%");
                        })
                        ->orWhereHas('genre', function ($genre) use ($keyword) {
                            $genre->where('name', 'like', "%{$keyword}%");
                        });
                });
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('books.index', compact('books'));
    }

    // Menampilkan detail buku
    public function show($id)
    {
        $book = Book::with(['author', 'genre'])->findOrFail($id);

        return view('books.show', compact('book'));
    }
}
