<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pengguna - BookStore Admin</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6fa;
            color: #202b3c;
        }
        .header {
            background: #101d35;
            color: white;
            padding: 20px 35px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header h2 { margin: 0; }
        .header a { color: #f5c66b; text-decoration: none; }
        .container {
            max-width: 1150px;
            margin: 35px auto;
            padding: 0 20px;
        }
        .panel {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 3px 15px #0000000d;
            overflow-x: auto;
        }
        h1 { margin-top: 0; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 14px;
            border-bottom: 1px solid #e8ebf0;
            text-align: left;
            white-space: nowrap;
        }
        th {
            background: #f0f3f8;
            color: #34435b;
        }
        .role {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            background: #e8eefb;
            color: #254b91;
            font-size: 12px;
            font-weight: bold;
        }
        .admin { background: #fff1d6; color: #946000; }
        .pagination { margin-top: 20px; }
        .pagination a, .pagination span {
            display: inline-block;
            padding: 7px 11px;
            margin-right: 4px;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-decoration: none;
            color: #243653;
        }
        .pagination span[aria-current="page"] {
            background: #101d35;
            color: white;
        }
        .empty { text-align: center; color: #777; padding: 25px; }
    </style>
</head>
<body>

<header class="header">
    <h2>BookStore Admin</h2>
    <a href="{{ route('admin.dashboard') }}">Kembali ke Dashboard</a>
</header>

<main class="container">
    <section class="panel">
        <h1>Daftar Pengguna</h1>
        <p>Data seluruh pengguna yang telah terdaftar di BookStore.</p>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Tanggal Registrasi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $users->firstItem() + $loop->index }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <span class="role {{ $user->role === 'admin' ? 'admin' : '' }}">
                                {{ ucfirst($user->role ?? 'user') }}
                            </span>
                        </td>
                        <td>{{ $user->created_at?->format('d-m-Y H:i') ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="empty">
                            Belum ada pengguna terdaftar.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="pagination">
            {{ $users->links() }}
        </div>
    </section>
</main>

</body>
</html>
