<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku | BookStore</title>

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: Arial, sans-serif;
            background: #f4f6fa;
            color: #263449;
        }

        .container {
            max-width: 850px;
            margin: 45px auto;
            padding: 0 20px;
        }

        .panel {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 18px #1426400d;
        }

        h1 {
            color: #142640;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
        }

        input, select, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #dce2ea;
            border-radius: 7px;
            font-size: 15px;
        }

        textarea {
            min-height: 110px;
            resize: vertical;
        }

        .error {
            color: #c0392b;
            font-size: 13px;
            margin-top: 6px;
        }

        .actions {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        button, .back-button {
            padding: 12px 20px;
            border: none;
            border-radius: 7px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
        }

        .save-button {
            background: #142640;
            color: white;
        }

        .back-button {
            background: #e5e9f0;
            color: #263449;
        }
    </style>
</head>

<body>

<div class="container">
    <div class="panel">

        <h1>Tambah Buku Baru</h1>

        @if($errors->any())
            <div class="error">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.books.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Judul Buku</label>
                <input
                    type="text"
                    name="title"
                    value="{{ old('title') }}"
                    placeholder="Masukkan judul buku"
                    required
                >
            </div>

            <div class="form-group">
                <label>Penulis</label>
                <select name="author_id" required>
                    <option value="">-- Pilih Penulis --</option>
                    @foreach($authors as $author)
                        <option
                            value="{{ $author->id }}"
                            {{ old('author_id') == $author->id ? 'selected' : '' }}
                        >
                            {{ $author->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Kategori</label>
                <select name="genre_id" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($genres as $genre)
                        <option
                            value="{{ $genre->id }}"
                            {{ old('genre_id') == $genre->id ? 'selected' : '' }}
                        >
                            {{ $genre->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>ISBN</label>
                <input
                    type="text"
                    name="isbn"
                    value="{{ old('isbn') }}"
                    placeholder="Masukkan ISBN (opsional)"
                >
            </div>

            <div class="form-group">
                <label>Harga Buku (Rp)</label>
                <input
                    type="number"
                    name="price"
                    value="{{ old('price', 0) }}"
                    min="0"
                    step="0.01"
                    required
                >
            </div>

            <div class="form-group">
                <label>Stok Buku</label>
                <input
                    type="number"
                    name="stock"
                    value="{{ old('stock', 0) }}"
                    min="0"
                    required
                >
            </div>

            <div class="form-group">
                <label>Deskripsi</label>
                <textarea
                    name="description"
                    placeholder="Masukkan deskripsi buku"
                >{{ old('description') }}</textarea>
            </div>

            <div class="actions">
                <button type="submit" class="save-button">
                    Simpan Buku
                </button>

                <a href="{{ route('admin.books.index') }}" class="back-button">
                    Kembali
                </a>
            </div>

        </form>
    </div>
</div>

</body>
</html>
