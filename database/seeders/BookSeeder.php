<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            [
                'author_id' => 1,
                'title' => 'Laskar Pelangi',
                'isbn' => '9789793062792',
                'price' => 95000,
                'stock' => 20,
                'description' => 'Novel karya Andrea Hirata.',
            ],
            [
                'author_id' => 2,
                'title' => 'Bumi',
                'isbn' => '9786020332956',
                'price' => 85000,
                'stock' => 15,
                'description' => 'Novel fantasi karya Tere Liye.',
            ],
            [
                'author_id' => 3,
                'title' => 'Perahu Kertas',
                'isbn' => '9786028811179',
                'price' => 90000,
                'stock' => 12,
                'description' => 'Novel karya Dee Lestari.',
            ],
            [
                'author_id' => 4,
                'title' => 'Bumi Manusia',
                'isbn' => '9789799731234',
                'price' => 100000,
                'stock' => 10,
                'description' => 'Novel karya Pramoedya Ananta Toer.',
            ],
            [
                'author_id' => 5,
                'title' => 'Ayat-Ayat Cinta',
                'isbn' => '9789793604044',
                'price' => 88000,
                'stock' => 18,
                'description' => 'Novel karya Habiburrahman El Shirazy.',
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
