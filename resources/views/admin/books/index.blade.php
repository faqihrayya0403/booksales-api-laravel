<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Buku | BookStore</title>

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

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

        .sidebar h2 { margin-bottom: 40px; }
        .sidebar h2 span { color: #e9b95b; }

        .sidebar a {
            display: block;
            padding: 14px;
            margin-bottom: 10px;
            color: #d7e0ed;
            text-decoration: none;
            border-radius: 7px;
        }

        .sidebar a:hover, .sidebar a.active {
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
            margin-bottom: 30px;
        }

        .topbar h1 { color: #142640; }

        .logout {
            background: #c94b4b;
            color: white;
            border: none;
            padding: 11px 18px;
            border-radius: 7px;
            cursor: pointer;
        }

        .panel {
            background: white;
            padding: 25px;
            border-radius: 12px;
            margin-bottom: 25px;
            box-shadow: 0 4px 18px #1426400d;
        }

        .panel h2 {
            color: #142640;
            margin-bottom: 20px;
        }

        .add-button {
            display: inline-block;
            background: #142640;
            color: white;
            padding: 12px 18px;
            border-radius: 7px;
            text-decoration: none;
            margin-bottom: 20px;
        }

        .success {
            background: #d9f5e5;
            color: #167447;
            padding: 14px;
            border-radius: 7px;
            margin-bottom: 20px;
        }

        .error {
            background: #fde2e2;
            color: #a52a2a;
            padding: 14px;
            border-radius: 7px;
            margin-bottom: 20px;
        }

        .table-wrapper { overflow-x: auto; }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 850px;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #edf0f4;
        }

        th {
            background: #f7f9fc;
            color: #53647b;
        }

        .edit-button {
            display: inline-block;
            background: #e9b95b;
            color: #142640;
            padding: 8px 12px;
            border-radius: 5px;
            text-decoration: none;
            border: none;
        }

        .delete-button {
            background: #c94b4b;
            color: white;
            padding: 8px 12px;
            border-radius: 5px;
            border: none;
        }

        .pagination { margin-top: 20px; }

        @media(max-width: 800px) {
            .sidebar {
                position: static;
                width: 100%;
                height: auto;
            }

            .main {
                margin-left: 0;
                padding: 20px;
            }
        }
    </style>
</head>

<body>

<aside class="sidebar">
    <h2>📚 Book<span>Store</span></h2>

    <a href="{{ route('admin.dashboard') }}">🏠 Dashboard</a>
    <a href="{{ route('admin.genres.index') }}">🏷️ Kelola Kategori</a>
    <a href="{{ route('admin.books.index') }}" class="active">📖 Kelola Buku</a>
    <a href="{{ route('home') }}">🌐 Halaman User</a>
</aside>

<main class="main">

    <div class="topbar">
        <h1>Kelola Buku</h1>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="logout" type="submit">Logout</button>
        </form>
    </div>

    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="error">{{ session('error') }}</div>
    @endif

    <section class="panel">
        <h2>Daftar Buku</h2>

        <a href="{{ route('admin.books.create') }}" class="add-button">
            + Tambah Buku
        </a>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul Buku</th>
                        <th>Penulis</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($books as $book)
                        <tr>
                            <td>{{ $books->firstItem() + $loop->index }}</td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author->name ?? '-' }}</td>
                            <td>{{ $book->genre->name ?? '-' }}</td>
                            <td>Rp {{ number_format($book->price, 0, ',', '.') }}</td>
                            <td>{{ $book->stock }}</td>

                            <td>
                                <div style="display:flex; gap:8px; align-items:center;">
                                    <a
                                        href="{{ route('admin.books.edit', $book) }}"
                                        class="edit-button"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('admin.books.destroy', $book) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus buku ini?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button class="delete-button" type="submit">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">Belum ada data buku.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination">
            {{ $books->links() }}
        </div>
    </section>

</main>

</body>
</html>
