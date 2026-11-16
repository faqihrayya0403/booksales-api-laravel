<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminGenreController extends Controller
{
    // Menampilkan semua kategori
    public function index()
    {
        $genres = Genre::withCount('books')
            ->latest()
            ->paginate(10);

        return view('admin.genres.index', compact('genres'));
    }

    // Menyimpan kategori baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:genres,name'],
        ]);

        Genre::create($validated);

        return redirect()->route('admin.genres.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    // Memperbarui kategori
    public function update(Request $request, Genre $genre)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('genres', 'name')->ignore($genre->id),
            ],
        ]);

        $genre->update($validated);

        return redirect()->route('admin.genres.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    // Menghapus kategori
    public function destroy(Genre $genre)
    {
        if ($genre->books()->exists()) {
            return redirect()->route('admin.genres.index')
                ->with('error', 'Kategori tidak bisa dihapus karena masih digunakan oleh buku.');
        }

        $genre->delete();

        return redirect()->route('admin.genres.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
