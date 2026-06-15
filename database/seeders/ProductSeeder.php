<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all()->keyBy('name');

        $products = [
            [
                'category' => 'Electronics',
                'name' => 'Wireless Noise-Cancelling Headphones',
                'description' => 'Over-ear headphones with active noise cancellation and 30-hour battery life. Folds flat for easy transport.',
                'price' => 79.99,
                'stock' => 45,
                'is_active' => true,
            ],
            [
                'category' => 'Electronics',
                'name' => 'USB-C Hub 7-in-1',
                'description' => 'Expands a single USB-C port into HDMI 4K, SD card reader, three USB-A ports, and pass-through charging.',
                'price' => 34.99,
                'stock' => 120,
                'is_active' => true,
            ],
            [
                'category' => 'Electronics',
                'name' => 'Mechanical Keyboard TKL',
                'description' => 'Tenkeyless mechanical keyboard with Cherry MX Brown switches and white backlight. Compact and quiet for office use.',
                'price' => 89.95,
                'stock' => 30,
                'is_active' => true,
            ],
            [
                'category' => 'Books',
                'name' => 'The Pragmatic Programmer',
                'description' => 'A classic guide to software craftsmanship covering career tips, tools, and coding philosophy for modern developers.',
                'price' => 49.99,
                'stock' => 60,
                'is_active' => true,
            ],
            [
                'category' => 'Books',
                'name' => 'Clean Code',
                'description' => 'Robert C. Martin shares principles and best practices for writing readable, maintainable software.',
                'price' => 39.99,
                'stock' => 80,
                'is_active' => true,
            ],
            [
                'category' => 'Books',
                'name' => 'Laravel: Up and Running',
                'description' => "A comprehensive introduction to the Laravel framework covering routing, Eloquent ORM, queues, and testing.",
                'price' => 44.99,
                'stock' => 25,
                'is_active' => true,
            ],
            [
                'category' => 'Clothing',
                'name' => 'Merino Wool Base Layer',
                'description' => 'Lightweight 150gsm merino wool long-sleeve shirt that regulates temperature in cold and mild weather.',
                'price' => 64.95,
                'stock' => 55,
                'is_active' => true,
            ],
            [
                'category' => 'Clothing',
                'name' => 'Water-Resistant Softshell Jacket',
                'description' => "Stretch softshell jacket with DWR coating, two zip pockets, and an adjustable hem. Ideal for hiking or commuting.",
                'price' => 119.00,
                'stock' => 0,
                'is_active' => false,
            ],
            [
                'category' => 'Clothing',
                'name' => 'Slim-Fit Chino Trousers',
                'description' => 'Classic mid-rise chinos in a cotton-stretch blend. Available in multiple lengths and a range of neutral colours.',
                'price' => 54.99,
                'stock' => 90,
                'is_active' => true,
            ],
            [
                'category' => 'Home & Garden',
                'name' => 'Stainless Steel French Press 1L',
                'description' => 'Double-walled insulated French press that keeps coffee hot for two hours without affecting flavour.',
                'price' => 29.99,
                'stock' => 70,
                'is_active' => true,
            ],
            [
                'category' => 'Home & Garden',
                'name' => 'Bamboo Cutting Board Set',
                'description' => 'Set of three kitchen cutting boards in graduated sizes made from sustainably sourced bamboo.',
                'price' => 22.49,
                'stock' => 140,
                'is_active' => true,
            ],
            [
                'category' => 'Sports',
                'name' => 'Yoga Mat 6mm Non-Slip',
                'description' => 'Eco-friendly TPE yoga mat with alignment markers, non-slip surface on both sides, and carrying strap.',
                'price' => 24.99,
                'stock' => 110,
                'is_active' => true,
            ],
            [
                'category' => 'Sports',
                'name' => 'Adjustable Dumbbell 24kg',
                'description' => 'Single dumbbell with quick-select dial adjustable from 2.5 kg to 24 kg, replacing a full set of 9 dumbbells.',
                'price' => 199.00,
                'stock' => 12,
                'is_active' => true,
            ],
            [
                'category' => 'Sports',
                'name' => 'Stainless Steel Water Bottle 750ml',
                'description' => 'Vacuum-insulated bottle that keeps drinks cold for 24 hours or hot for 12 hours. Leak-proof lid, BPA-free.',
                'price' => 17.99,
                'stock' => 200,
                'is_active' => true,
            ],
        ];

        foreach ($products as $data) {
            Product::create([
                'category_id' => $categories[$data['category']]->id,
                'name'        => $data['name'],
                'description' => $data['description'],
                'price'       => $data['price'],
                'stock'       => $data['stock'],
                'is_active'   => $data['is_active'],
            ]);
        }
    }
}
