<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'id' => Str::uuid(),
            'title' => '1984',
            'description' => 'Dystopian novel.',
            'price' => 19.99,
            'stock' => 50,
            'category' => 'sci-fi',
        ]);
    }
}
