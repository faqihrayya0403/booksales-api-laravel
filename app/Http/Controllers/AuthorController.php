<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    // Menampilkan semua author
    public function index()
    {
        return response()->json([
            'success' => true,
            'message' => 'Data penulis berhasil diambil',
            'data' => Author::all()
        ], 200);
    }

    // Menambahkan author baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'bio' => 'nullable|string',
        ]);

        $author = Author::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Penulis berhasil ditambahkan',
            'data' => $author
        ], 201);
    }

    // Menampilkan satu author berdasarkan ID
    public function show(string $id)
    {
        $author = Author::find($id);

        if (!$author) {
            return response()->json([
                'success' => false,
                'message' => 'Penulis tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data penulis berhasil diambil',
            'data' => $author
        ], 200);
    }

    // Memperbarui author
    public function update(Request $request, string $id)
    {
        $author = Author::find($id);

        if (!$author) {
            return response()->json([
                'success' => false,
                'message' => 'Penulis tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'bio' => 'nullable|string',
        ]);

        $author->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Penulis berhasil diperbarui',
            'data' => $author
        ], 200);
    }

    // Menghapus author
    public function destroy(string $id)
    {
        $author = Author::find($id);

        if (!$author) {
            return response()->json([
                'success' => false,
                'message' => 'Penulis tidak ditemukan'
            ], 404);
        }

        $author->delete();

        return response()->json([
            'success' => true,
            'message' => 'Penulis berhasil dihapus'
        ], 200);
    }
}
