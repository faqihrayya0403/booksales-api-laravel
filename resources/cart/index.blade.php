<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - BookStore</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f4f6fa;
            color: #17233d;
            padding: 35px 20px;
        }

        .container {
            max-width: 1000px;
            margin: auto;
        }

        h1 {
            margin-bottom: 10px;
        }

        .subtitle {
            color: #64748b;
            margin-bottom: 25px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 15px 10px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        th {
            color: #64748b;
            font-size: 13px;
        }

        input[type="number"] {
            width: 75px;
            padding: 8px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
        }

        button, .btn {
            border: none;
            padding: 9px 13px;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-size: 13px;
        }

        .update {
            background: #e8edf8;
            color: #172b55;
        }

        .delete {
            background: #fee2e2;
            color: #b91c1c;
        }

        .checkout {
            background: #c69b45;
            color: white;
            padding: 13px 22px;
            font-weight: bold;
        }

        .back {
            background: #172b55;
            color: white;
            margin-top: 20px;
        }

        .total {
            text-align: right;
            font-size: 20px;
            font-weight: bold;
            margin-top: 25px;
        }

        .alert {
            padding: 12px;
            margin-bottom: 15px;
            border-radius: 7px;
            background: #dcfce7;
            color: #166534;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
        }

        .empty {
            text-align: center;
            padding: 35px;
            color: #64748b;
        }

        @media(max-width: 650px) {
            .card {
                overflow-x: auto;
            }

            table {
                min-width: 650px;
            }
        }
    </style>
</head>

<body>
<div class="container">

    <h1>Keranjang Belanja</h1>
    <p class="subtitle">Periksa buku yang ingin kamu beli.</p>

    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert error">{{ session('error') }}</div>
    @endif

    @if($errors->any())
        <div class="alert error">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="card">

        @if($books->isEmpty())

            <div class="empty">
                <h3>Keranjang masih kosong</h3>
                <p>Silakan pilih buku dari katalog terlebih dahulu.</p>

                <a href="{{ route('books.index') }}" class="btn back">
                    Lihat Katalog Buku
                </a>
            </div>

        @else

            <table>
                <thead>
                    <tr>
                        <th>Nama Buku</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($books as $book)
                        <tr>
                            <td>
                                <strong>{{ $book->title }}</strong>
                            </td>

                            <td>
                                Rp{{ number_format($book->price, 0, ',', '.') }}
                            </td>

                            <td>
                                <form action="{{ route('cart.update', $book->id) }}"
                                      method="POST">
                                    @csrf
                                    @method('PUT')

                                    <input type="number"
                                           name="quantity"
                                           value="{{ $book->quantity }}"
                                           min="1"
                                           max="{{ $book->stock }}">

                                    <button type="submit" class="update">
                                        Update
                                    </button>
                                </form>
                            </td>

                            <td>
                                Rp{{ number_format($book->subtotal, 0, ',', '.') }}
                            </td>

                            <td>
                                <form action="{{ route('cart.remove', $book->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Hapus buku dari keranjang?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="delete">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="total">
                Total:
                Rp{{ number_format($total, 0, ',', '.') }}
            </div>

            <div style="text-align:right; margin-top:20px;">
                <button type="button"
                        class="checkout"
                        disabled
                        style="opacity:.6; cursor:not-allowed;">
                    Checkout (Belum Aktif)
                </button>
            </div>

        @endif

    </div>

    <a href="{{ route('books.index') }}" class="btn back">
        ← Kembali ke Katalog
    </a>

</div>
</body>
</html>
