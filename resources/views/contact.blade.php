<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Admin - BookStore</title>

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
            min-height: 100vh;
        }

        header {
            background: #101b3d;
            color: white;
            padding: 22px 8%;
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
            max-width: 750px;
            margin: 55px auto;
            padding: 0 20px;
        }

        .card {
            background: white;
            padding: 35px;
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.07);
        }

        h1 {
            margin-bottom: 12px;
            color: #101b3d;
        }

        .description {
            color: #64748b;
            line-height: 1.6;
            margin-bottom: 25px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
            margin-top: 18px;
        }

        input, textarea {
            width: 100%;
            padding: 13px;
            border: 1px solid #d7dce5;
            border-radius: 8px;
            font-size: 15px;
        }

        textarea {
            min-height: 140px;
            resize: vertical;
        }

        button {
            margin-top: 25px;
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 8px;
            background: #d6a84f;
            color: #101b3d;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #c49335;
        }

        .success {
            background: #dcfce7;
            color: #166534;
            padding: 13px;
            border-radius: 8px;
            margin-bottom: 18px;
        }

        .error {
            color: #dc2626;
            font-size: 13px;
            margin-top: 5px;
        }

        footer {
            text-align: center;
            padding: 25px;
            color: #64748b;
        }

        .back {
            display: inline-block;
            margin-top: 20px;
            color: #172554;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>

<body>

<header>
    <h2>BookStore</h2>
    <a href="{{ route('home') }}">Kembali ke Beranda</a>
</header>

<div class="container">
    <div class="card">

        <h1>Hubungi Admin</h1>

        <p class="description">
            Punya pertanyaan, saran, atau kendala?
            Kirim pesan kepada admin BookStore melalui formulir berikut.
        </p>

        @if (session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('contact.store') }}" method="POST">
            @csrf

            <label for="name">Nama Lengkap</label>
            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name', auth()->user()->name) }}"
                required
            >
            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="email">Email</label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email', auth()->user()->email) }}"
                required
            >
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="subject">Subjek</label>
            <input
                type="text"
                id="subject"
                name="subject"
                value="{{ old('subject') }}"
                placeholder="Masukkan subjek pesan"
                required
            >
            @error('subject')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="message">Isi Pesan</label>
            <textarea
                id="message"
                name="message"
                placeholder="Tuliskan pesan kamu..."
                required
            >{{ old('message') }}</textarea>
            @error('message')
                <div class="error">{{ $message }}</div>
            @enderror

            <button type="submit">Kirim Pesan</button>
        </form>

        <a href="{{ route('home') }}" class="back">
            ← Kembali ke Beranda
        </a>

    </div>
</div>

<footer>
    Developed by Muhammad Faqih Rayya.
</footer>

</body>
</html>
