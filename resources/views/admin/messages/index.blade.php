<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Masuk - BookStore</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f4f6fb;
            color: #172554;
        }

        header {
            background: #101b3d;
            color: white;
            padding: 22px 7%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h2 {
            color: #e8bd69;
        }

        header a {
            color: white;
            text-decoration: none;
        }

        .container {
            max-width: 1150px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 14px;
            box-shadow: 0 5px 25px rgba(0,0,0,.06);
            overflow-x: auto;
        }

        h1 {
            margin-bottom: 10px;
        }

        .description {
            color: #64748b;
            margin-bottom: 25px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 850px;
        }

        th, td {
            padding: 15px;
            border-bottom: 1px solid #e2e8f0;
            text-align: left;
            vertical-align: top;
        }

        th {
            background: #101b3d;
            color: white;
        }

        tr:hover {
            background: #f8fafc;
        }

        .message-content {
            max-width: 280px;
            white-space: pre-wrap;
            overflow-wrap: anywhere;
        }

        .empty {
            text-align: center;
            padding: 35px;
            color: #64748b;
        }

        .back {
            display: inline-block;
            margin-bottom: 20px;
            color: #172554;
            text-decoration: none;
            font-weight: bold;
        }

        .pagination {
            margin-top: 20px;
        }

        footer {
            text-align: center;
            padding: 25px;
            color: #64748b;
        }
    </style>
</head>

<body>

<header>
    <h2>BookStore Admin</h2>
    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
</header>

<div class="container">

    <a href="{{ route('admin.dashboard') }}" class="back">
        ← Kembali ke Dashboard
    </a>

    <div class="card">

        <h1>Pesan Masuk</h1>

        <p class="description">
            Daftar pesan yang dikirim pengguna melalui Contact Admin.
        </p>

        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Pengirim</th>
                    <th>Email</th>
                    <th>Subjek</th>
                    <th>Isi Pesan</th>
                    <th>Tanggal</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($messages as $message)
                    <tr>
                        <td>{{ $messages->firstItem() + $loop->index }}</td>

                        <td>
                            {{ $message->name }}
                        </td>

                        <td>
                            {{ $message->email }}
                        </td>

                        <td>
                            {{ $message->subject }}
                        </td>

                        <td class="message-content">
                            {{ $message->message }}
                        </td>

                        <td>
                            {{ $message->created_at->format('d-m-Y H:i') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="empty">
                            Belum ada pesan masuk.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="pagination">
            {{ $messages->links() }}
        </div>

    </div>
</div>

<footer>
     Developed by Muhammad Faqih Rayya.
</footer>

</body>
</html>
