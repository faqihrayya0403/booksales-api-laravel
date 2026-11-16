<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | BookStore</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f4f6fa;
            color: #263449;
        }

        .sidebar {
            position: fixed;
            width: 250px;
            height: 100vh;
            background: #142640;
            color: white;
            padding: 30px 20px;
        }

        .sidebar h2 {
            margin-bottom: 40px;
            font-size: 24px;
        }

        .sidebar h2 span {
            color: #e9b95b;
        }

        .sidebar a {
            display: block;
            padding: 14px;
            margin-bottom: 10px;
            color: #d7e0ed;
            text-decoration: none;
            border-radius: 7px;
        }

        .sidebar a.active,
        .sidebar a:hover {
            background: #294566;
            color: white;
        }

        .main {
            margin-left: 250px;
            padding: 35px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 35px;
        }

        .topbar h1 {
            color: #142640;
            font-size: 27px;
        }

        .logout {
            background: #c94b4b;
            color: white;
            border: none;
            padding: 11px 18px;
            border-radius: 7px;
            cursor: pointer;
        }

        .welcome {
            background: linear-gradient(120deg, #142640, #294d73);
            color: white;
            padding: 30px;
            border-radius: 12px;
            margin-bottom: 30px;
        }

        .welcome h2 {
            margin-bottom: 10px;
        }

        .welcome p {
            color: #d7e0ed;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 18px #1426400d;
        }

        .card .icon {
            font-size: 30px;
            margin-bottom: 15px;
        }

        .card h3 {
            color: #78869a;
            font-size: 14px;
            margin-bottom: 12px;
        }

        .card .number {
            color: #142640;
            font-size: 30px;
            font-weight: bold;
        }

        .note {
            margin-top: 30px;
            padding: 22px;
            background: white;
            border-radius: 12px;
            line-height: 1.7;
            color: #65748a;
        }

        @media (max-width: 950px) {
            .cards {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 650px) {
            .sidebar {
                position: static;
                width: 100%;
                height: auto;
            }

            .main {
                margin-left: 0;
                padding: 20px;
            }

            .cards {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <aside class="sidebar">
        <h2>📚 Book<span>Store</span></h2>

        <a href="{{ route('admin.dashboard') }}" class="active">
            🏠 Dashboard
        </a>

        <a href="{{ route('books.index') }}">
            📖 Katalog Buku
        </a>

        <a href="{{ route('home') }}">
            🌐 Halaman User
        </a>
    </aside>

    <main class="main">

        <div class="topbar">
            <h1>Admin Dashboard</h1>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="logout" type="submit">Logout</button>
            </form>
        </div>

        <section class="welcome">
            <h2>Selamat Datang, {{ auth()->user()->name }}!</h2>
            <p>Kelola dan pantau seluruh data BookStore melalui dashboard admin.</p>
        </section>

        <section class="cards">

            <div class="card">
                <div class="icon">📚</div>
                <h3>Total Buku</h3>
                <div class="number">{{ $totalBooks }}</div>
            </div>

            <div class="card">
                <div class="icon">👥</div>
                <h3>Total User</h3>
                <div class="number">{{ $totalUsers }}</div>
            </div>

            <div class="card">
                <div class="icon">🏷️</div>
                <h3>Total Kategori</h3>
                <div class="number">{{ $totalGenres }}</div>
            </div>

            <div class="card">
                <div class="icon">🛒</div>
                <h3>Total Transaksi</h3>
                <div class="number">{{ $totalTransactions }}</div>
            </div>

        </section>

        <section class="note">
            <strong>Informasi Admin</strong>
            <p>
                Gunakan dashboard ini untuk memantau data buku,
                kategori, pengguna, dan transaksi pada aplikasi BookStore.
            </p>
        </section>

    </main>

</body>
</html>
