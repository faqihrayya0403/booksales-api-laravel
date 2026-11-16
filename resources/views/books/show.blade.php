<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Buku | BookStore</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f4f6fa;
            color: #263238;
        }

        nav {
            background: #172b4d;
            color: white;
            padding: 20px 7%;
        }

        nav h2 {
            font-size: 23px;
        }

        .container {
            max-width: 950px;
            margin: 45px auto;
            padding: 0 20px;
        }

        .detail-card {
            background: white;
            border-radius: 14px;
            padding: 35px;
            display: grid;
            grid-template-columns: 250px 1fr;
            gap: 35px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.06);
        }

        .cover {
            background: linear-gradient(135deg, #e6edf5, #cbd8e8);
            min-height: 300px;
            border-radius: 12px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 100px;
        }

        .category {
            display: inline-block;
            background: #eaf0f8;
            color: #34577c;
            padding: 7px 13px;
            border-radius: 20px;
            font-size: 13px;
            margin-bottom: 18px;
        }

        h1 {
            color: #172b4d;
            margin-bottom: 15px;
            font-size: 30px;
        }

        .author {
            color: #687782;
            margin-bottom: 25px;
        }

        .price {
            font-size: 25px;
            color: #188653;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .stock {
            margin-bottom: 25px;
            color: #687782;
        }

        .description-title {
            margin-bottom: 10px;
            color: #172b4d;
        }

        .description {
            line-height: 1.7;
            color: #687782;
        }

        .back-button {
            display: inline-block;
            margin-top: 30px;
            padding: 13px 22px;
            background: #172b4d;
            color: white;
            text-decoration: none;
            border-radius: 7px;
        }

        .back-button:hover {
            background: #34577c;
        }

        footer {
            text-align: center;
            padding: 25px;
            color: #687782;
        }

        @media (max-width: 650px) {
            .detail-card {
                grid-template-columns: 1fr;
            }

            .cover {
                min-height: 220px;
            }
        }
    </style>
</head>

<body>

    <nav>
        <h2>📚 BookStore</h2>
    </nav>

    <main class="container">

        <div class="detail-card">

            <div class="cover">
                📖
            </div>

            <div class="information">

                <span class="category">
                    {{ $book->genre->name ?? 'Umum' }}
                </span>

                <h1>{{ $book->title }}</h1>

                <p class="author">
                    Penulis: {{ $book->author->name ?? 'Belum tersedia' }}
                </p>

                <p class="price">
                    Rp {{ number_format($book->price, 0, ',', '.') }}
                </p>

                <p class="stock">
                    Stok tersedia: {{ $book->stock }}
                </p>

                <h3 class="description-title">
                    Deskripsi Buku
                </h3>

                <p class="description">
                    {{ $book->description ?? 'Belum ada deskripsi buku.' }}
                </p>

                <a href="{{ route('books.index') }}" class="back-button">
                    ← Kembali ke Katalog
                </a>

            </div>

        </div>

    </main>

    <footer>
        Developed by Muhammad Faqih Rayya.
    </footer>

</body>
</html>
