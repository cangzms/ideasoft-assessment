<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'id' => 100,
            'name' => 'Black&Decker A7062 40 Parça Cırcırlı Tornavida Seti',
            'category' => 1,
            'price' => '400',
            'stock' => 10
        ]);
        // Ürün 3
        Product::create([
            'id' => 101,
            'name' => 'Viko Karre Anahtar - Beyaz',
            'category' => 2,
            'price' => '49.50',
            'stock' => 10
        ]);

        // Ürün 5
        Product::create([
            'id' => 102,
            'name' => 'Schneider Asfora Beyaz Komütatör',
            'category' => 1,
            'price' => '12.95',
            'stock' => 10
        ]);
    }
}
