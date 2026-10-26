<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorSeeder extends Seeder
{
    public function run(): void
    {
        $authors = [
            [
                'name' => 'Andrea Hirata',
                'email' => 'andrea@example.com',
                'bio' => 'Penulis novel Laskar Pelangi.',
            ],
            [
                'name' => 'Tere Liye',
                'email' => 'tereliye@example.com',
                'bio' => 'Penulis novel Indonesia.',
            ],
            [
                'name' => 'Dee Lestari',
                'email' => 'dee@example.com',
                'bio' => 'Penulis novel dan karya sastra.',
            ],
            [
                'name' => 'Habiburrahman El Shirazy',
                'email' => 'habiburrahman@example.com',
                'bio' => 'Penulis novel Ayat-Ayat Cinta.',
            ],
            [
                'name' => 'Pramoedya Ananta Toer',
                'email' => 'pramoedya@example.com',
                'bio' => 'Sastrawan Indonesia.',
            ],
        ];

        foreach ($authors as $author) {
            Author::create($author);
        }
    }
}
