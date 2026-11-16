<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Buku - BookStore</title>
    <style>
        * { box-sizing: border-box; }
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
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        nav a { color: white; text-decoration: none; }
        .container { max-width: 1100px; margin: 35px auto; padding: 0 20px; }
        .search { display: flex; gap: 10px; margin: 20px 0 30px; }
        .search input {
            flex: 1; padding: 12px; border: 1px solid #ccc;
            border-radius: 6px;
        }
        button {
            padding: 12px 20px; border: 0; border-radius: 6px;
            background: #243b55; color: white; cursor: pointer;
        }
        .books {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
            gap: 20px;
        }
        .book {
            background: white; padding: 22px; border-radius: 10px;
            box-shadow: 0 2px 8px #00000010;
        }
        .book-icon { font-size: 35px; }
        .price { color: #16834a; font-weight: bold; }
        .muted { color: #687782; font-size: 14px; }
        .pagination { margin-top: 25px; }
        a { color: #243b55; }
        @media (max-width: 500px) {
            nav { padding: 16px 5%; }
            .search { flex-direction: column; }
        }
    </style>
</head>
<body>
    <nav>
        <h2>📚 BookStore</h2>
        <a href="{{ route('home') }}">Kembali ke Beranda</a>
    </nav>

    <main class="container">
        <h1>Katalog Buku</h1>
        <p class="muted">Temukan buku favorit kamu di BookStore.</p>

        <form class="search" method="GET" action="{{ route('books.index') }}">
            <input
                type="text"
                name="q"
                placeholder="Cari judul, penulis, atau kategori..."
                value="{{ request('q') }}"
            >
            <button type="submit">Cari Buku</button>
        </form>

        @if ($books->count() > 0)
            <div class="books">
                @foreach ($books as $book)
                    <article class="book">
                        <div class="book-icon">📖</div>
                        <h3>{{ $book->title }}</h3>

                        <p class="muted">
                            Penulis:
                            {{ $book->author->name ?? 'Belum tersedia' }}
                        </p>

                        <p class="muted">
                            Kategori:
                            {{ $book->genre->name ?? 'Belum tersedia' }}
                        </p>

                        <p class="price">
                            Rp {{ number_format($book->price, 0, ',', '.') }}
                        </p>

                        <p class="muted">Stok: {{ $book->stock }}</p>

                        @if ($book->description)
                            <p>{{ $book->description }}</p>
                        @endif
                    </article>
                @endforeach
            </div>

            <div class="pagination">
                {{ $books->links() }}
            </div>
        @else
            <p>Belum ada buku yang ditemukan.</p>
        @endif
    </main>
</body>
</html>
