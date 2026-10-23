<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    public static function data(): array
    {
        return [
            ['id' => 1, 'name' => 'Fiksi'],
            ['id' => 2, 'name' => 'Misteri'],
            ['id' => 3, 'name' => 'Romansa'],
            ['id' => 4, 'name' => 'Fantasi'],
            ['id' => 5, 'name' => 'Pendidikan'],
        ];
    }
}
