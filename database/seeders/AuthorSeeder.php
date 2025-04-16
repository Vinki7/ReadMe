<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Author;
use Illuminate\Support\Str;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Author::create([
            'id' => Str::uuid(),
            'name' => 'George',
            'surname' => 'Orwell',
            'birth_date' => '1903-06-25',
            'biography' => 'English novelist and essayist.',
        ]);
    }
}
