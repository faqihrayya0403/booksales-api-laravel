<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookStore | Beranda</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f5f7fb;
            color: #243047;
        }

        /* NAVBAR */
        nav {
            background: #142640;
            padding: 20px 8%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
        }

        .logo {
            font-size: 25px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .logo span {
            color: #e9b95b;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .nav-menu a {
            color: white;
            text-decoration: none;
            font-size: 14px;
            transition: 0.3s;
        }

        .nav-menu a:hover {
            color: #e9b95b;
        }

        .nav-menu form {
            margin: 0;
        }

        .logout {
            background: transparent;
            border: 1px solid #ffffff80;
            color: white;
            padding: 10px 20px;
            border-radius: 7px;
            cursor: pointer;
            font-size: 14px;
            transition: 0.3s;
        }

        .logout:hover {
            background: #e9b95b;
            color: #142640;
            border-color: #e9b95b;
        }

        /* HERO */
        .hero {
            min-height: 520px;
            padding: 80px 8%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 40px;
            background: linear-gradient(120deg, #142640, #24476b);
            color: white;
            overflow: hidden;
        }

        .hero-content {
            max-width: 600px;
        }

        .welcome {
            color: #e9b95b;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 20px;
        }

        .hero h1 {
            font-size: 48px;
            line-height: 1.2;
            margin-bottom: 20px;
        }

        .hero h1 span {
            color: #e9b95b;
        }

        .hero p {
            color: #d6dfeb;
            font-size: 17px;
            line-height: 1.8;
            margin-bottom: 30px;
        }

        .catalog-button {
            display: inline-block;
            background: #e9b95b;
            color: #142640;
            text-decoration: none;
            padding: 15px 25px;
            border-radius: 8px;
            font-weight: 700;
            transition: 0.3s;
        }

        .catalog-button:hover {
            background: #f5ce7e;
            transform: translateY(-3px);
        }

        .hero-icon {
            font-size: 180px;
            opacity: 0.9;
            padding: 30px;
            filter: drop-shadow(0 15px 20px #00000030);
        }

        /* FEATURES */
        .features {
            padding: 65px 8%;
            text-align: center;
        }

        .features h2 {
            color: #142640;
            font-size: 30px;
            margin-bottom: 12px;
        }

        .subtitle {
            color: #778397;
            margin-bottom: 35px;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 22px;
        }

        .feature-card {
            background: white;
            padding: 30px 22px;
            border-radius: 13px;
            box-shadow: 0 5px 25px #1426400d;
            transition: 0.3s;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px #14264018;
        }

        .feature-card .icon {
            font-size: 38px;
            margin-bottom: 15px;
        }

        .feature-card h3 {
            color: #142640;
            margin-bottom: 10px;
        }

        .feature-card p {
            color: #778397;
            line-height: 1.6;
            font-size: 14px;
        }

        /* FOOTER */
        footer {
            background: #142640;
            color: #cbd5e1;
            text-align: center;
            padding: 25px;
            font-size: 14px;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            nav {
                flex-direction: column;
                gap: 18px;
            }

            .nav-menu {
                flex-wrap: wrap;
                justify-content: center;
                gap: 15px;
            }

            .hero {
                flex-direction: column;
                text-align: center;
                padding: 65px 7%;
            }

            .hero h1 {
                font-size: 36px;
            }

            .hero-icon {
                font-size: 110px;
            }

            .feature-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav>
        <div class="logo">📚 Book<span>Store</span></div>

        <div class="nav-menu">
            <a href="{{ route('home') }}">Beranda</a>
            <a href="{{ route('books.index') }}">Katalog</a>
            <a href="{{ route('orders.index') }}">Pesanan Saya</a>
            <a href="{{ route('cart.index') }}">Keranjang</a>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout">Logout ↗</button>
            </form>
        </div>
    </nav>

    <!-- HERO -->
    <section class="hero">
        <div class="hero-content">
            <div class="welcome">Welcome to BookStore</div>

            <h1>
                Selamat Datang di <span>BookStore!</span>
            </h1>

            <p>
                Halo, {{ auth()->user()->name }}.
                <br>
                Temukan berbagai buku menarik dan nikmati pengalaman
                berbelanja buku dengan mudah, nyaman, dan menyenangkan.
            </p>

            <a href="{{ route('books.index') }}" class="catalog-button">
                📖 Lihat Katalog Buku →
            </a>
        </div>

        <div class="hero-icon">📚</div>
    </section>

    <!-- FEATURES -->
    <section class="features">
        <h2>Mengapa BookStore?</h2>

        <p class="subtitle">
            Temukan pengalaman baru dalam menjelajahi dunia buku.
        </p>

        <div class="feature-grid">

            <div class="feature-card">
                <div class="icon">📚</div>
                <h3>Koleksi Buku</h3>
                <p>
                    Jelajahi berbagai pilihan buku dengan beragam
                    genre dan judul menarik.
                </p>
            </div>

            <div class="feature-card">
                <div class="icon">🔎</div>
                <h3>Mudah Dicari</h3>
                <p>
                    Temukan buku favorit dengan fitur pencarian
                    yang praktis dan mudah digunakan.
                </p>
            </div>

            <div class="feature-card">
                <div class="icon">🛒</div>
                <h3>Belanja Praktis</h3>
                <p>
                    Nikmati pengalaman menjelajahi katalog buku
                    melalui satu platform.
                </p>
            </div>

        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        Developed by Muhammad Faqih Rayya.
    </footer>

</body>
</html>
