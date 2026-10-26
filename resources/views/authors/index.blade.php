
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Author - BookSales</title>
</head>
<body>
    <h1>Daftar Author Buku</h1>

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Author</th>
                <th>Email</th>
                <th>Biografi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($authors as $author)
                <tr>
                    <td>{{ $author->id }}</td>
                    <td>{{ $author->name }}</td>
                    <td>{{ $author->email }}</td>
                    <td>{{ $author->bio }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Belum ada data author.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <p><a href="/books">Lihat Data Buku</a></p>
    <p><a href="/genres">Lihat Data Genre</a></p>
</body>
</html>
