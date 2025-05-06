<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Author;

class ProductAuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product_authors')->insert([
            'product_id' => Product::first()->id,
            'author_id' => Author::first()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
