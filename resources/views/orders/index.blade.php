<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya - BookStore</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: Arial, sans-serif;
            background: #f4f6fa;
            color: #17233d;
        }

        header {
            background: #101c35;
            color: white;
            padding: 22px 8%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h2 { color: #e5bd68; }

        header a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
        }

        .container {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .heading { margin-bottom: 25px; }

        .heading h1 {
            font-size: 30px;
            margin-bottom: 8px;
        }

        .heading p { color: #68748a; }

        .card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,.05);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 650px;
        }

        th, td {
            padding: 16px 12px;
            text-align: left;
            border-bottom: 1px solid #e8ebf1;
        }

        th {
            background: #101c35;
            color: #e5bd68;
        }

        .badge {
            background: #fff4d8;
            color: #946b12;
            padding: 7px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .empty {
            text-align: center;
            padding: 45px 15px;
            color: #68748a;
        }

        .empty a {
            display: inline-block;
            margin-top: 18px;
            background: #101c35;
            color: white;
            padding: 12px 20px;
            border-radius: 7px;
            text-decoration: none;
        }

        .pagination { margin-top: 20px; }

        footer {
            text-align: center;
            padding: 25px;
            color: #7b8495;
            font-size: 13px;
        }

        @media(max-width: 600px) {
            header { padding: 18px 5%; }
            header a { margin-left: 10px; font-size: 13px; }
            .heading h1 { font-size: 25px; }
        }
    </style>
</head>
<body>

<header>
    <h2>BookStore</h2>
    <nav>
        <a href="{{ route('home') }}">Beranda</a>
        <a href="{{ route('books.index') }}">Katalog</a>
        <a href="{{ route('cart.index') }}">Keranjang</a>
    </nav>
</header>

<div class="container">
    <div class="heading">
        <h1>Pesanan Saya</h1>
        <p>Berikut adalah riwayat transaksi pembelian buku Anda.</p>
    </div>

    <div class="card">
        @if($orders->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>No. Pesanan</th>
                        <th>Nama Buku</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Tanggal</th>
                        <th>Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->order_number }}</td>
                            <td>{{ $order->book->title ?? 'Buku tidak tersedia' }}</td>
                            <td>{{ $order->quantity }} buku</td>
                            <td>Rp{{ number_format($order->total_amount, 0, ',', '.') }}</td>
                            <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                            <td><span class="badge">COD</span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="pagination">
                {{ $orders->links() }}
            </div>
        @else
            <div class="empty">
                <h3>Belum Ada Pesanan</h3>
                <p>Anda belum melakukan pembelian buku.</p>
                <a href="{{ route('books.index') }}">Mulai Belanja</a>
            </div>
        @endif
    </div>
</div>

<footer>
   Developed by Muhammad Faqih Rayya.
</footer>

</body>
</html>
