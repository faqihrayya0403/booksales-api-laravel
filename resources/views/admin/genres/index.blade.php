<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kategori | BookStore</title>

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

        .sidebar a:hover,
        .sidebar a.active {
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

        .topbar h1 {
            color: #142640;
        }

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

        .form-group {
            display: flex;
            gap: 12px;
        }

        input {
            flex: 1;
            padding: 13px;
            border: 1px solid #dce2ea;
            border-radius: 7px;
            font-size: 15px;
        }

        button {
            cursor: pointer;
        }

        .add-button {
            background: #142640;
            color: white;
            border: none;
            padding: 13px 20px;
            border-radius: 7px;
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

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 16px;
            text-align: left;
            border-bottom: 1px solid #edf0f4;
        }

        th {
            background: #f7f9fc;
            color: #53647b;
        }

        .edit-form {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .edit-input {
            width: 100%;
            max-width: 250px;
            padding: 9px;
        }

        .edit-button {
            background: #e9b95b;
            color: #142640;
            border: none;
            padding: 9px 13px;
            border-radius: 5px;
        }

        .delete-button {
            background: #c94b4b;
            color: white;
            border: none;
            padding: 9px 13px;
            border-radius: 5px;
        }

        .pagination {
            margin-top: 20px;
        }

        .pagination a,
        .pagination span {
            margin-right: 8px;
        }

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

            .form-group {
                flex-direction: column;
            }

            .panel {
                overflow-x: auto;
            }

            .edit-form {
                min-width: 250px;
            }
        }
    </style>
</head>

<body>

<aside class="sidebar">
    <h2>📚 Book<span>Store</span></h2>

    <a href="{{ route('admin.dashboard') }}">🏠 Dashboard</a>
    <a href="{{ route('admin.genres.index') }}" class="active">🏷️ Kelola Kategori</a>
    <a href="{{ route('books.index') }}">📖 Katalog Buku</a>
    <a href="{{ route('home') }}">🌐 Halaman User</a>
</aside>

<main class="main">

    <div class="topbar">
        <h1>Kelola Kategori Buku</h1>

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

    @if($errors->any())
        <div class="error">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section class="panel">
        <h2>Tambah Kategori Baru</h2>

        <form action="{{ route('admin.genres.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <input
                    type="text"
                    name="name"
                    placeholder="Masukkan nama kategori..."
                    value="{{ old('name') }}"
                    required
                >

                <button type="submit" class="add-button">
                    + Tambah Kategori
                </button>
            </div>
        </form>
    </section>

    <section class="panel">
        <h2>Daftar Kategori</h2>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Jumlah Buku</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($genres as $genre)
                    <tr>
                        <td>{{ $genres->firstItem() + $loop->index }}</td>

                        <td>
                            {{ $genre->name }}
                        </td>

                        <td>
                            {{ $genre->books_count }} buku
                        </td>

                        <td>
                            <div style="display:flex; gap:8px; align-items:center; flex-wrap:wrap;">

                                <form
                                    action="{{ route('admin.genres.update', $genre) }}"
                                    method="POST"
                                    class="edit-form"
                                >
                                    @csrf
                                    @method('PUT')

                                    <input
                                        type="text"
                                        name="name"
                                        value="{{ $genre->name }}"
                                        class="edit-input"
                                        required
                                    >

                                    <button class="edit-button" type="submit">
                                        Simpan
                                    </button>
                                </form>

                                <form
                                    action="{{ route('admin.genres.destroy', $genre) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus kategori ini?')"
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
                        <td colspan="4">Belum ada kategori buku.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="pagination">
            {{ $genres->links() }}
        </div>
    </section>

</main>

</body>
</html>
