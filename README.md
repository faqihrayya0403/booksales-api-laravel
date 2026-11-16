# BookStore — Laravel Web Application & REST API

Aplikasi toko buku berbasis web menggunakan Laravel 12 dan MySQL.

## Identitas Developer
- Nama: Muhammad Faqih Rayya
- NIM: 0110224212
- Program Studi: Teknik Informatika

## Fitur User
- Registrasi dan login
- Katalog dan pencarian buku
- Detail buku
- Keranjang belanja
- Checkout pembayaran COD
- Riwayat pesanan
- About Us
- Contact Admin

## Fitur Admin
- Dashboard
- CRUD buku
- CRUD kategori
- Daftar pengguna
- Daftar transaksi
- Daftar pesan pengguna

## REST API
- Autentikasi Laravel Sanctum
- API Books
- API Authors
- API Genres
- API Transactions
- Role-Based Access Control (RBAC)

## Teknologi
- PHP 8.2
- Laravel 12
- MySQL
- HTML, CSS, Blade
- Laravel Sanctum
- Composer
- XAMPP

## Instalasi

1. Clone repository:
   git clone https://github.com/faqihrayya0403/booksales-api-laravel.git

2. Masuk folder project:
   cd booksales-api-laravel

3. Install dependency:
   composer install

4. Salin konfigurasi:
   copy .env.example .env

5. Generate key:
   php artisan key:generate

6. Buat database MySQL bernama booksales_api.

7. Sesuaikan konfigurasi database pada file .env.

8. Jalankan migration:
   php artisan migrate

9. Jalankan aplikasi:
   php artisan serve

10. Buka http://127.0.0.1:8000

## Pembayaran
Menggunakan metode Cash on Delivery (COD).
Integrasi payment gateway Midtrans belum tersedia.

## Repository
https://github.com/faqihrayya0403/booksales-api-laravel

---
Developed by Muhammad Faqih Rayya.
