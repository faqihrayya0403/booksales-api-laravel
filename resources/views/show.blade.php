<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Buku - BookStore</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            color: #263238;
        }
        nav {
            background: #243b55;
            color: white;
            padding: 20px 7%;
        }
        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 30px;
            background: white;
            border-radius: 12px;
        }
        .icon { font-size: 65px; }
        .price { color: #16834a; font-size: 22px; font-weight: bold; }
        .button {
            display: inline-block;
            padding: 12px 20px;
            background: #243b55;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            margin-top: 15px;
        }
        .muted { color: #687782; }
    </style>
</head>
<body>

<nav>
    <h2>📚 BookStore</h2>
</nav>

<main class="container">

    <div class="icon">📖</div>

    <h1>{{ $book->title }}</h1>

    <p class="muted">
        Penulis: {{ $book->author->name ?? 'Belum tersedia' }}
    </p>

    <p class="muted">
        Kategori: {{ $book->genre->name ?? 'Belum tersedia' }}
    </p>

    <p class="price">
        Rp {{ number_format($book->price, 0, ',', '.') }}
    </p>

    <p>Stok tersedia: {{ $book->stock }}</p>

    <h3>Deskripsi Buku</h3>

    <p>
        {{ $book->description ?? 'Belum ada deskripsi buku.' }}
    </p>

    <a href="{{ route('books.index') }}" class="button">
        Kembali ke Katalog
    </a>

</main>

</body>
</html>
