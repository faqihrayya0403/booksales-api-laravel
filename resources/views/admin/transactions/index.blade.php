
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Transaksi - BookStore Admin</title>

    <style>
        * {
            box-sizing: border-box;
        }

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

        .header h2 {
            margin: 0;
        }

        .header a {
            color: #f5c66b;
            text-decoration: none;
        }

        .container {
            max-width: 1300px;
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

        h1 {
            margin-top: 0;
        }

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

        .amount {
            font-weight: bold;
            color: #176b48;
        }

        .quantity {
            text-align: center;
            font-weight: bold;
        }

        .badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 5px;
            background: #e8edf8;
            color: #172b55;
            font-size: 12px;
        }

        .empty {
            text-align: center;
            color: #777;
            padding: 25px;
        }

        .pagination {
            margin-top: 20px;
        }

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

        @media (max-width: 700px) {
            .header {
                padding: 18px;
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }
        }
    </style>
</head>

<body>

<header class="header">
    <h2>BookStore Admin</h2>
    <a href="{{ route('admin.dashboard') }}">
        ← Kembali ke Dashboard
    </a>
</header>

<main class="container">
    <section class="panel">

        <h1>Daftar Transaksi / Pesanan</h1>

        <p>
            Daftar pesanan buku dari seluruh pengguna BookStore.
        </p>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nomor Pesanan</th>
                    <th>Nama Pelanggan</th>
                    <th>Email</th>
                    <th>Judul Buku</th>
                    <th>Jumlah</th>
                    <th>Total Pembayaran</th>
                    <th>Tanggal Transaksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($transactions as $transaction)
                    <tr>
                        <td>
                            {{ $transactions->firstItem() + $loop->index }}
                        </td>

                        <td>
                            {{ $transaction->order_number }}
                        </td>

                        <td>
                            {{ $transaction->customer?->name ?? 'Pengguna tidak ditemukan' }}
                        </td>

                        <td>
                            {{ $transaction->customer?->email ?? '-' }}
                        </td>

                        <td>
                            {{ $transaction->book?->title ?? 'Buku tidak ditemukan' }}
                        </td>

                        <td class="quantity">
                            <span class="badge">
                                {{ $transaction->quantity }} Buku
                            </span>
                        </td>

                        <td class="amount">
                            Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}
                        </td>

                        <td>
                            {{ $transaction->created_at?->format('d-m-Y H:i') ?? '-' }}
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="8" class="empty">
                            Belum ada transaksi atau pesanan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="pagination">
            {{ $transactions->links() }}
        </div>

    </section>
</main>

</body>
</html>
