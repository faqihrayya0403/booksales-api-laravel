<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - BookStore</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6fa;
            color: #26344a;
        }

        header {
            background: #101d35;
            color: white;
            padding: 20px 7%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h2 {
            margin: 0;
        }

        header a {
            color: #f5c66b;
            text-decoration: none;
        }

        .hero {
            background: #172b4d;
            color: white;
            text-align: center;
            padding: 75px 20px;
        }

        .hero h1 {
            font-size: 42px;
            margin-bottom: 15px;
        }

        .hero p {
            color: #d4dbea;
            line-height: 1.7;
        }

        .container {
            max-width: 1000px;
            margin: 45px auto;
            padding: 0 20px;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px #0000000b;
        }

        .card h2 {
            color: #172b4d;
            margin-top: 0;
        }

        .card p {
            line-height: 1.8;
            color: #596579;
        }

        .developer {
            border-left: 5px solid #e7b653;
        }

        .back {
            display: inline-block;
            background: #172b4d;
            color: white;
            padding: 12px 22px;
            border-radius: 7px;
            text-decoration: none;
            margin-bottom: 35px;
        }

        footer {
            background: #101d35;
            color: #d4dbea;
            text-align: center;
            padding: 22px;
        }
    </style>
</head>

<body>

<header>
    <h2>BookStore</h2>
    <a href="{{ route('home') }}">Kembali ke Beranda</a>
</header>

<section class="hero">
    <h1>Tentang BookStore</h1>
    <p>
        Temukan berbagai buku menarik dan perluas wawasan
        bersama BookStore.
    </p>
</section>

<main class="container">

    <section class="card">
        <h2>Siapa Kami?</h2>
        <p>
            BookStore merupakan aplikasi toko buku berbasis web
            yang menyediakan berbagai pilihan buku untuk membantu
            pengguna menemukan dan mendapatkan buku sesuai kebutuhan.
        </p>
    </section>

    <section class="card">
        <h2>Visi Kami</h2>
        <p>
            Menjadi platform toko buku yang mudah digunakan,
            informatif, dan membantu meningkatkan minat membaca
            masyarakat.
        </p>
    </section>

    <section class="card">
        <h2>Misi Kami</h2>
        <p>
            Menyediakan katalog buku yang mudah dicari,
            memberikan informasi buku secara jelas,
            serta menghadirkan pengalaman belanja buku
            yang praktis dan nyaman.
        </p>
    </section>

    <section class="card developer">
        <h2>Informasi Pengembang</h2>
        <p><strong>Nama:</strong> Muhammad Faqih Rayya</p>
        <p><strong>NIM:</strong> 0110224212</p>
        <p><strong>Program Studi:</strong> Teknik Informatika</p>
        <p><strong>Proyek:</strong> BookStore Web Application</p>
    </section>

    <a href="{{ route('home') }}" class="back">
        Kembali ke Beranda
    </a>

</main>

<footer>
    &copy; {{ date('Y') }} BookStore.
    Developed by Muhammad Faqih Rayya.
</footer>

</body>
</html>
