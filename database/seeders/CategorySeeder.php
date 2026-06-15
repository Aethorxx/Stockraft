<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Электроника',
            'Книги',
            'Одежда',
            'Дом и сад',
            'Спорт',
            'Красота и здоровье',
            'Игрушки и игры',
            'Автотовары',
            'Продукты питания',
            'Офис и канцелярия',
        ];

        foreach ($categories as $name) {
            Category::create(['name' => $name]);
        }
    }
}
