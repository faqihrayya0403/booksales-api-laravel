<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Buku | BookStore</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f5f6fa;
            color: #263238;
        }

        nav {
            background: #172b4d;
            padding: 18px 7%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
        }

        .brand {
            font-size: 23px;
            font-weight: bold;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 22px;
        }

        nav a {
            color: white;
            text-decoration: none;
            font-size: 14px;
        }

        nav a:hover {
            color: #e9a23b;
        }

        .hero {
            background: linear-gradient(120deg, #172b4d, #34577c);
            color: white;
            padding: 65px 20px;
            text-align: center;
        }

        .hero h1 {
            font-size: 38px;
            margin-bottom: 14px;
        }

        .hero p {
            color: #dce6f1;
            line-height: 1.6;
        }

        .container {
            max-width: 1150px;
            margin: 40px auto;
            padding: 0 22px;
        }

        .search-form {
            display: flex;
            max-width: 650px;
            margin: 0 auto 40px;
            gap: 10px;
        }

        .search-form input {
            flex: 1;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 15px;
            outline: none;
        }

        .search-form button {
            background: #e9a23b;
            color: #172b4d;
            border: none;
            padding: 0 25px;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
        }

        .section-title {
            margin-bottom: 25px;
            font-size: 25px;
            color: #172b4d;
        }

        .books {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(235px, 1fr));
            gap: 25px;
        }

        .book-card {
            background: white;
            border-radius: 13px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.06);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .book-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 9px 24px rgba(0,0,0,0.12);
        }

        .book-cover {
            height: 155px;
            background: linear-gradient(135deg, #e6edf5, #d1dce9);
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 65px;
        }

        .book-info {
            padding: 20px;
        }

        .category {
            display: inline-block;
            background: #eaf0f8;
            color: #34577c;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 12px;
            margin-bottom: 12px;
        }

        .book-info h3 {
            font-size: 19px;
            margin-bottom: 10px;
            color: #172b4d;
        }

        .author {
            color: #7b8794;
            font-size: 13px;
            margin-bottom: 15px;
        }

        .description {
            font-size: 13px;
            color: #65717d;
            line-height: 1.6;
            min-height: 42px;
            margin-bottom: 15px;
        }

        .price {
            font-size: 19px;
            color: #188653;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .stock {
            color: #7b8794;
            font-size: 13px;
            margin-bottom: 18px;
        }

        .detail-button {
            display: block;
            text-align: center;
            background: #172b4d;
            color: white;
            padding: 12px;
            border-radius: 7px;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.2s;
        }

        .detail-button:hover {
            background: #34577c;
        }

        .add-cart-button {
            display: block;
            width: 100%;
            text-align: center;
            background: #e9a23b;
            color: #172b4d;
            padding: 12px;
            border: none;
            border-radius: 7px;
            font-weight: bold;
            cursor: pointer;
            margin-bottom: 10px;
        }

        .add-cart-button:hover {
            background: #d89028;
        }

        .add-cart-button:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .alert {
            padding: 14px;
            margin-bottom: 20px;
            border-radius: 8px;
            background: #dcfce7;
            color: #166534;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
        }

        .empty {
            text-align: center;
            padding: 45px;
            background: white;
            border-radius: 12px;
            color: #7b8794;
        }

        .pagination {
            margin-top: 35px;
        }

        footer {
            text-align: center;
            padding: 25px;
            color: #7b8794;
            font-size: 13px;
        }

        @media (max-width: 600px) {
            .hero h1 {
                font-size: 28px;
            }

            .search-form {
                flex-direction: column;
            }

            .search-form button {
                padding: 14px;
            }

            nav {
                flex-direction: column;
                gap: 15px;
            }

            .nav-links {
                flex-wrap: wrap;
                justify-content: center;
            }
        }
    </style>
</head>

<body>

    <nav>
        <div class="brand">📚 BookStore</div>

        <div class="nav-links">
            <a href="{{ route('home') }}">← Beranda</a>
            <a href="{{ route('cart.index') }}">🛒 Keranjang Belanja</a>
        </div>
    </nav>

    <section class="hero">
        <h1>Temukan Buku Favoritmu</h1>
        <p>
            Jelajahi berbagai koleksi buku menarik dan temukan
            inspirasi baru dari setiap halaman.
        </p>
    </section>

    <main class="container">

        @if(session('success'))
            <div class="alert">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">
                {{ $errors->first() }}
            </div>
        @endif

        <form class="search-form" method="GET"
              action="{{ route('books.index') }}">

            <input
                type="text"
                name="q"
                placeholder="Cari judul, penulis, atau kategori buku..."
                value="{{ request('q') }}"
            >

            <button type="submit">Cari Buku</button>
        </form>

        <h2 class="section-title">Koleksi Buku Kami</h2>

        @if ($books->count() > 0)

            <div class="books">

                @foreach ($books as $book)

                    <article class="book-card">

                        <div class="book-cover">
                            📖
                        </div>

                        <div class="book-info">

                            <span class="category">
                                {{ $book->genre->name ?? 'Umum' }}
                            </span>

                            <h3>{{ $book->title }}</h3>

                            <p class="author">
                                Oleh {{ $book->author->name ?? 'Penulis tidak tersedia' }}
                            </p>

                            <p class="description">
                                {{ $book->description ?? 'Belum ada deskripsi buku.' }}
                            </p>

                            <p class="price">
                                Rp {{ number_format($book->price, 0, ',', '.') }}
                            </p>

                            <p class="stock">
                                Stok tersedia: {{ $book->stock }}
                            </p>

                            @if ($book->stock > 0)

                                <form action="{{ route('cart.add', $book->id) }}"
                                      method="POST">

                                    @csrf

                                    <input type="hidden" name="quantity" value="1">

                                    <button type="submit" class="add-cart-button">
                                        🛒 Tambah ke Keranjang
                                    </button>

                                </form>

                            @else

                                <button class="add-cart-button" disabled>
                                    Stok Habis
                                </button>

                            @endif

                            <a href="{{ route('books.show', $book->id) }}"
                               class="detail-button">
                                Lihat Detail →
                            </a>

                        </div>

                    </article>

                @endforeach

            </div>

            <div class="pagination">
                {{ $books->links() }}
            </div>

        @else

            <div class="empty">
                <h3>📚 Buku belum ditemukan</h3>
                <p>Coba gunakan kata kunci pencarian yang lain.</p>
            </div>

        @endif

    </main>

    <footer>
        Developed by Muhammad Faqih Rayya.
    </footer>

</body>
</html>
